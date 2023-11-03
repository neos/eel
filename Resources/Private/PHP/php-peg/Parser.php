<?php
namespace PhpPeg;

/**
 * We cache the last regex result. This is a low-cost optimization, because we have to do an un-anchored match + check match position anyway
 * (alternative is to do an anchored match on a string cut with substr, but that is very slow for long strings). We then don't need to recheck
 * for any position between current position and eventual match position - result will be the same
 *  Of course, the next regex might be outside that bracket - after the bracket if other matches have progressed beyond the match position, or before
 *  the bracket if a failed match + restore has moved the current position backwards - so we have to check that too.
 */
class ParserRegexp {
    protected ?Parser $parser = null;
    protected string $rx = '';
    protected ?array $matches = null;
    protected ?int $match_pos = null;
    protected ?int $check_pos = null;

	function __construct($parser, $rx) {
		$this->parser = $parser;
		$this->rx = $rx . 'Sx';

		$this->matches = NULL;
		$this->match_pos = NULL; // NULL is no-match-to-end-of-string, unless check_pos also == NULL, in which case means undefined
		$this->check_pos = NULL;
	}

	function match() {
		$current_pos = $this->parser->pos;
		$dirty = $this->check_pos === NULL || $this->check_pos > $current_pos || ($this->match_pos !== NULL && $this->match_pos < $current_pos);

		if ($dirty) {
			$this->check_pos = $current_pos;
			$matched = preg_match($this->rx, $this->parser->string, $this->matches, PREG_OFFSET_CAPTURE, $this->check_pos);
			if ($matched) {
				$this->match_pos = $this->matches[0][1];
			} else {
				$this->match_pos = NULL;
			}
		}

		if ($this->match_pos === $current_pos) {
			$this->parser->pos += strlen($this->matches[0][0]);
			return $this->matches[0][0];
		}

		return FALSE;
	}
}

/**
 * Parser base class
 * - handles current position in string
 * - handles matching that position against literal or rx
 * - some abstraction of code that would otherwise be repeated many times in a compiled grammer, mostly related to calling user functions
 *   for result construction and building
 */
class Parser {
    public string $string = '';
    public int $pos = 0;
    protected int $depth = 0;
    protected array $regexps = [];

	function __construct($string) {
		$this->string = $string;
		$this->pos = 0;

		$this->depth = 0;

		$this->regexps = [];
	}

	function whitespace() {
		$matched = preg_match('/[ \t]+/', $this->string, $matches, PREG_OFFSET_CAPTURE, $this->pos);
		if ($matched && $matches[0][1] == $this->pos) {
			$this->pos += strlen($matches[0][0]);
			return ' ';
		}
		return FALSE;
	}

	function literal($token) {
		/* Debugging: * / print( "Looking for token '$token' @ '" . substr( $this->string, $this->pos ) . "'\n" ) ; /* */
		$toklen = strlen($token);
		$substr = substr($this->string, $this->pos, $toklen);
		if ($substr == $token) {
			$this->pos += $toklen;
			return $token;
		}
		return FALSE;
	}

	function rx($rx) {
		if (!isset($this->regexps[$rx])) {
			$this->regexps[$rx] = new ParserRegexp($this, $rx);
		}
		return $this->regexps[$rx]->match();
	}

	function expression($result, $stack, $value) {
		$stack[] = $result;
		$rv = false;

		/* Search backwards through the sub-expression stacks */
		for ($i = count($stack) - 1; $i >= 0; $i--) {
			$node = $stack[$i];

			if (isset($node[$value])) {
				$rv = $node[$value];
				break;
			}

			foreach ($this->typestack($node['_matchrule']) as $type) {
				$callback = [$this, "{$type}_DLR{$value}"];
				if (is_callable($callback)) {
					$rv = call_user_func($callback);
					if ($rv !== FALSE) {
						break;
					}
				}
			}
		}

		if ($rv === false) {
			$rv = @$this->$value;
		}
		if ($rv === false) {
			$rv = @$this->$value();
		}

		return is_array($rv) ? $rv['text'] : ($rv ? $rv : '');
	}

	function packhas($key, $pos) {
		return false;
	}

	function packread($key, $pos) {
		throw new \Exception('PackRead after PackHas=>false in Parser.php');
	}

	function packwrite($key, $pos, $res) {
		return $res;
	}

	function typestack($name) {
		$prop = "match_{$name}_typestack";
		return $this->$prop;
	}

	function construct($matchrule, $name, $arguments = null) {
		$result = ['_matchrule' => $matchrule, 'name' => $name, 'text' => ''];
		if ($arguments) {
			$result = array_merge($result, $arguments);
		}

		foreach ($this->typestack($matchrule) as $type) {
			$callback = [$this, "{$type}__construct"];
			if (is_callable($callback)) {
				call_user_func_array($callback, [&$result]);
				break;
			}
		}

		return $result;
	}

	function finalise(&$result) {
		foreach ($this->typestack($result['_matchrule']) as $type) {
			$callback = [$this, "{$type}__finalise"];
			if (is_callable($callback)) {
				call_user_func_array($callback, [&$result]);
				break;
			}
		}

		return $result;
	}

	function store(&$result, $subres, $storetag = NULL) {
		$result['text'] .= $subres['text'];

		$storecalled = false;

		foreach ($this->typestack($result['_matchrule']) as $type) {
			$callback = [$this, $storetag ? "{$type}_{$storetag}" : "{$type}_{$subres['name']}"];
			if (is_callable($callback)) {
				call_user_func_array($callback, [&$result, $subres]);
				$storecalled = true;
				break;
			}

			$globalcb = [$this, "{$type}_STR"];
			if (is_callable($globalcb)) {
				call_user_func_array($globalcb, [&$result, $subres]);
				$storecalled = true;
				break;
			}
		}

		if ($storetag && !$storecalled) {
			if (!isset($result[$storetag])) {
				$result[$storetag] = $subres;
			}
			else {
				if (isset($result[$storetag]['text'])) {
					$result[$storetag] = [$result[$storetag]];
				}
				$result[$storetag][] = $subres;
			}
		}
	}
}

/**
 * By inheriting from Packrat instead of Parser, the parser will run in linear time (instead of exponential like
 * Parser), but will require a lot more memory, since every match-attempt at every position is memorised.
 * We now use a string as a byte-array to store position information rather than a straight array for memory reasons. This
 * means there is a (roughly) 8MB limit on the size of the string we can parse
 *
 * @author Hamish Friedlander
 */
class Packrat extends Parser {
    protected string $packstatebase = '';
    protected array $packstate = [];
    protected array $packres = [];

	function __construct($string) {
		parent::__construct($string);

		$max = unpack('N', "\x00\xFD\xFF\xFF");
		if (strlen($string) > $max[1]) {
			user_error('Attempting to parse string longer than Packrat Parser can handle', E_USER_ERROR);
		}

		$this->packstatebase = str_repeat("\xFF", strlen($string) * 3);
		$this->packstate = [];
		$this->packres = [];
	}

	function packhas($key, $pos) {
		$pos *= 3;
		return isset($this->packstate[$key]) && $this->packstate[$key][$pos] != "\xFF";
	}

	function packread($key, $pos) {
		$pos *= 3;
		if ($this->packstate[$key][$pos] == "\xFE") {
			return FALSE;
		}

		$this->pos = ord($this->packstate[$key][$pos]) << 16 | ord($this->packstate[$key][$pos + 1]) << 8 | ord($this->packstate[$key][$pos + 2]);
		return $this->packres["$key:$pos"];
	}

	function packwrite($key, $pos, $res) {
		if (!isset($this->packstate[$key])) {
			$this->packstate[$key] = $this->packstatebase;
		}

		$pos *= 3;

		if ($res !== FALSE) {
			$i = pack('N', $this->pos);

			$this->packstate[$key][$pos] = $i[1];
			$this->packstate[$key][$pos + 1] = $i[2];
			$this->packstate[$key][$pos + 2] = $i[3];

			$this->packres["$key:$pos"] = $res;
		}
		else {
			$this->packstate[$key][$pos] = "\xFE";
		}

		return $res;
	}
}

/**
 * FalseOnlyPackrat only remembers which results where false. Experimental.
 *
 * @author Hamish Friedlander
 */
class FalseOnlyPackrat extends Parser {

	function __construct($string) {
		parent::__construct($string);

		$this->packstatebase = str_repeat('.', strlen($string));
		$this->packstate = [];
	}

	function packhas($key, $pos) {
		return isset($this->packstate[$key]) && $this->packstate[$key][$pos] == 'F';
	}

	function packread($key, $pos) {
		return FALSE;
	}

	function packwrite($key, $pos, $res) {
		if (!isset($this->packstate[$key])) {
			$this->packstate[$key] = $this->packstatebase;
		}

		if ($res === FALSE) {
			$this->packstate[$key][$pos] = 'F';
		}

		return $res;
	}
}

/**
 * Conservative Packrat will only memo-ize a result on the second hit, making it more memory-lean than Packrat,
 * but less likely to go exponential that Parser. Because the store logic is much more complicated this is a net
 * loss over Parser for many simple grammars.
 *
 * @author Hamish Friedlander
 */
class ConservativePackrat extends Parser {

	// The $value default parameter is NOT used, it is just added to conform to interface
	function packhas($key, $value = NULL) {
		return isset($this->packres[$key]) && $this->packres[$key] !== NULL;
	}

	// The $value default parameter is NOT used, it is just added to conform to interface
	function packread($key, $value = NULL) {
		$this->pos = $this->packpos[$key];
		return $this->packres[$key];
	}

	// The $thirdArgument default parameter is NOT used, it is just added to conform to interface
	function packwrite($key, $res, $thirdArgument = NULL) {
		if (isset($this->packres[$key])) {
			$this->packres[$key] = $res;
			$this->packpos[$key] = $this->pos;
		}
		else {
			$this->packres[$key] = NULL;
		}
		return $res;
	}
}

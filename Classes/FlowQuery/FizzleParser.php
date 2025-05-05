<?php
namespace Neos\Eel\FlowQuery;
// @codingStandardsIgnoreFile

/*
 * This file is part of the Neos.Eel package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

/*
WARNING: This file has been machine generated. Do not edit it, or your changes will be overwritten next time it is compiled.
*/

/**
 * Fizzle parser
 *
 * This is the parser for a CSS-like selector language for Objects and Content Repository Nodes.
 * You can think of it as "Sizzle for PHP" (hence the name).
 *
 * @Neos\Flow\Annotations\Proxy(false)
 */
class FizzleParser extends \Neos\Eel\AbstractParser {
/* ObjectIdentifier: / [0-9a-zA-Z_-]+ / */
protected $match_ObjectIdentifier_typestack = array('ObjectIdentifier');
function match_ObjectIdentifier ($stack = array()) {
	$matchrule = "ObjectIdentifier"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->rx( '/ [0-9a-zA-Z_-]+ /' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* NodeName: / [a-z0-9\-]+ / */
protected $match_NodeName_typestack = array('NodeName');
function match_NodeName ($stack = array()) {
	$matchrule = "NodeName"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->rx( '/ [a-z0-9\-]+ /' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}




/* FilterGroup: :Filter ( S ',' S :Filter )* */
protected $match_FilterGroup_typestack = array('FilterGroup');
function match_FilterGroup ($stack = array()) {
	$matchrule = "FilterGroup"; $result = $this->construct($matchrule, $matchrule, null);
	$_9 = NULL;
	do {
		$matcher = 'match_'.'Filter'; $key = $matcher; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
		if ($subres !== FALSE) {
			$this->store( $result, $subres, "Filter" );
		}
		else { $_9 = FALSE; break; }
		while (true) {
			$res_8 = $result;
			$pos_8 = $this->pos;
			$_7 = NULL;
			do {
				$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) { $this->store( $result, $subres ); }
				else { $_7 = FALSE; break; }
				if (substr($this->string,$this->pos,1) == ',') {
					$this->pos += 1;
					$result["text"] .= ',';
				}
				else { $_7 = FALSE; break; }
				$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) { $this->store( $result, $subres ); }
				else { $_7 = FALSE; break; }
				$matcher = 'match_'.'Filter'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) {
					$this->store( $result, $subres, "Filter" );
				}
				else { $_7 = FALSE; break; }
				$_7 = TRUE; break;
			}
			while(0);
			if( $_7 === FALSE) {
				$result = $res_8;
				$this->pos = $pos_8;
				unset( $res_8 );
				unset( $pos_8 );
				break;
			}
		}
		$_9 = TRUE; break;
	}
	while(0);
	if( $_9 === TRUE ) { return $this->finalise($result); }
	if( $_9 === FALSE) { return FALSE; }
}

function FilterGroup_Filter (&$result, $sub) {
		if (!isset($result['Filters'])) {
			$result['Filters'] = array();
		}
		$result['Filters'][] = $sub;
	}

/* Filter: ( PathFilter | IdentifierFilter | PropertyNameFilter )?  ( AttributeFilters:AttributeFilter )* */
protected $match_Filter_typestack = array('Filter');
function match_Filter ($stack = array()) {
	$matchrule = "Filter"; $result = $this->construct($matchrule, $matchrule, null);
	$_25 = NULL;
	do {
		$res_21 = $result;
		$pos_21 = $this->pos;
		$_20 = NULL;
		do {
			$_18 = NULL;
			do {
				$res_11 = $result;
				$pos_11 = $this->pos;
				$matcher = 'match_'.'PathFilter'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) {
					$this->store( $result, $subres );
					$_18 = TRUE; break;
				}
				$result = $res_11;
				$this->pos = $pos_11;
				$_16 = NULL;
				do {
					$res_13 = $result;
					$pos_13 = $this->pos;
					$matcher = 'match_'.'IdentifierFilter'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) {
						$this->store( $result, $subres );
						$_16 = TRUE; break;
					}
					$result = $res_13;
					$this->pos = $pos_13;
					$matcher = 'match_'.'PropertyNameFilter'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) {
						$this->store( $result, $subres );
						$_16 = TRUE; break;
					}
					$result = $res_13;
					$this->pos = $pos_13;
					$_16 = FALSE; break;
				}
				while(0);
				if( $_16 === TRUE ) { $_18 = TRUE; break; }
				$result = $res_11;
				$this->pos = $pos_11;
				$_18 = FALSE; break;
			}
			while(0);
			if( $_18 === FALSE) { $_20 = FALSE; break; }
			$_20 = TRUE; break;
		}
		while(0);
		if( $_20 === FALSE) {
			$result = $res_21;
			$this->pos = $pos_21;
			unset( $res_21 );
			unset( $pos_21 );
		}
		while (true) {
			$res_24 = $result;
			$pos_24 = $this->pos;
			$_23 = NULL;
			do {
				$matcher = 'match_'.'AttributeFilter'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) {
					$this->store( $result, $subres, "AttributeFilters" );
				}
				else { $_23 = FALSE; break; }
				$_23 = TRUE; break;
			}
			while(0);
			if( $_23 === FALSE) {
				$result = $res_24;
				$this->pos = $pos_24;
				unset( $res_24 );
				unset( $pos_24 );
				break;
			}
		}
		$_25 = TRUE; break;
	}
	while(0);
	if( $_25 === TRUE ) { return $this->finalise($result); }
	if( $_25 === FALSE) { return FALSE; }
}

function Filter_PathFilter (&$result, $sub) {
		$result['PathFilter'] = $sub['text'];
	}

function Filter_IdentifierFilter (&$result, $sub) {
		$result['IdentifierFilter'] = substr($sub['text'], 1);
	}

function Filter_PropertyNameFilter (&$result, $sub) {
		$result['PropertyNameFilter'] = $sub['Identifier'];
	}

function Filter_AttributeFilters (&$result, $sub) {
		if (!isset($result['AttributeFilters'])) {
			$result['AttributeFilters'] = array();
		}
		$result['AttributeFilters'][] = $sub;
	}

/* IdentifierFilter: '#':ObjectIdentifier */
protected $match_IdentifierFilter_typestack = array('IdentifierFilter');
function match_IdentifierFilter ($stack = array()) {
	$matchrule = "IdentifierFilter"; $result = $this->construct($matchrule, $matchrule, null);
	$_29 = NULL;
	do {
		if (substr($this->string,$this->pos,1) == '#') {
			$this->pos += 1;
			$result["text"] .= '#';
		}
		else { $_29 = FALSE; break; }
		$matcher = 'match_'.'ObjectIdentifier'; $key = $matcher; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
		if ($subres !== FALSE) {
			$this->store( $result, $subres, "ObjectIdentifier" );
		}
		else { $_29 = FALSE; break; }
		$_29 = TRUE; break;
	}
	while(0);
	if( $_29 === TRUE ) { return $this->finalise($result); }
	if( $_29 === FALSE) { return FALSE; }
}


/* PropertyNameFilter: Identifier */
protected $match_PropertyNameFilter_typestack = array('PropertyNameFilter');
function match_PropertyNameFilter ($stack = array()) {
	$matchrule = "PropertyNameFilter"; $result = $this->construct($matchrule, $matchrule, null);
	$matcher = 'match_'.'Identifier'; $key = $matcher; $pos = $this->pos;
	$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
	if ($subres !== FALSE) {
		$this->store( $result, $subres );
		return $this->finalise($result);
	}
	else { return FALSE; }
}

function PropertyNameFilter_Identifier (&$result, $sub) {
		$result['Identifier'] = $sub['text'];
	}

/* PathFilter: ( '/' ( NodeName ( '/' NodeName )* )? ) | ( NodeName '/' NodeName ( '/' NodeName )* ) */
protected $match_PathFilter_typestack = array('PathFilter');
function match_PathFilter ($stack = array()) {
	$matchrule = "PathFilter"; $result = $this->construct($matchrule, $matchrule, null);
	$_52 = NULL;
	do {
		$res_32 = $result;
		$pos_32 = $this->pos;
		$_41 = NULL;
		do {
			if (substr($this->string,$this->pos,1) == '/') {
				$this->pos += 1;
				$result["text"] .= '/';
			}
			else { $_41 = FALSE; break; }
			$res_40 = $result;
			$pos_40 = $this->pos;
			$_39 = NULL;
			do {
				$matcher = 'match_'.'NodeName'; $key = $matcher; $pos = $this->pos;
				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
				if ($subres !== FALSE) { $this->store( $result, $subres ); }
				else { $_39 = FALSE; break; }
				while (true) {
					$res_38 = $result;
					$pos_38 = $this->pos;
					$_37 = NULL;
					do {
						if (substr($this->string,$this->pos,1) == '/') {
							$this->pos += 1;
							$result["text"] .= '/';
						}
						else { $_37 = FALSE; break; }
						$matcher = 'match_'.'NodeName'; $key = $matcher; $pos = $this->pos;
						$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
						if ($subres !== FALSE) {
							$this->store( $result, $subres );
						}
						else { $_37 = FALSE; break; }
						$_37 = TRUE; break;
					}
					while(0);
					if( $_37 === FALSE) {
						$result = $res_38;
						$this->pos = $pos_38;
						unset( $res_38 );
						unset( $pos_38 );
						break;
					}
				}
				$_39 = TRUE; break;
			}
			while(0);
			if( $_39 === FALSE) {
				$result = $res_40;
				$this->pos = $pos_40;
				unset( $res_40 );
				unset( $pos_40 );
			}
			$_41 = TRUE; break;
		}
		while(0);
		if( $_41 === TRUE ) { $_52 = TRUE; break; }
		$result = $res_32;
		$this->pos = $pos_32;
		$_50 = NULL;
		do {
			$matcher = 'match_'.'NodeName'; $key = $matcher; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
			if ($subres !== FALSE) { $this->store( $result, $subres ); }
			else { $_50 = FALSE; break; }
			if (substr($this->string,$this->pos,1) == '/') {
				$this->pos += 1;
				$result["text"] .= '/';
			}
			else { $_50 = FALSE; break; }
			$matcher = 'match_'.'NodeName'; $key = $matcher; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
			if ($subres !== FALSE) { $this->store( $result, $subres ); }
			else { $_50 = FALSE; break; }
			while (true) {
				$res_49 = $result;
				$pos_49 = $this->pos;
				$_48 = NULL;
				do {
					if (substr($this->string,$this->pos,1) == '/') {
						$this->pos += 1;
						$result["text"] .= '/';
					}
					else { $_48 = FALSE; break; }
					$matcher = 'match_'.'NodeName'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) { $this->store( $result, $subres ); }
					else { $_48 = FALSE; break; }
					$_48 = TRUE; break;
				}
				while(0);
				if( $_48 === FALSE) {
					$result = $res_49;
					$this->pos = $pos_49;
					unset( $res_49 );
					unset( $pos_49 );
					break;
				}
			}
			$_50 = TRUE; break;
		}
		while(0);
		if( $_50 === TRUE ) { $_52 = TRUE; break; }
		$result = $res_32;
		$this->pos = $pos_32;
		$_52 = FALSE; break;
	}
	while(0);
	if( $_52 === TRUE ) { return $this->finalise($result); }
	if( $_52 === FALSE) { return FALSE; }
}


/* AttributeFilter:
  '[' S
      (
          ( Operator:( 'instanceof' | '!instanceof' ) S ( Operand:StringLiteral | Operand:UnquotedOperand ) S )
          | ( :PropertyPath S
              (
                  Operator:( 'instanceof' | '!instanceof' | PrefixMatchInsensitive | PrefixMatch | SuffixMatchInsensitive | SuffixMatch | SubstringMatchInsensitivee | SubstringMatch | ExactMatchInsensitive | ExactMatch | NotEqualMatchInsensitive | NotEqualMatch | LessThanOrEqualMatch | LessThanMatch | GreaterThanOrEqualMatch | GreaterThanMatch )
                  S ( Operand:StringLiteral | Operand:NumberLiteral | Operand:BooleanLiteral | Operand:UnquotedOperand ) S
              )?
          )
       )
  S ']' */
protected $match_AttributeFilter_typestack = array('AttributeFilter');
function match_AttributeFilter ($stack = array()) {
	$matchrule = "AttributeFilter"; $result = $this->construct($matchrule, $matchrule, null);
	$_167 = NULL;
	do {
		if (substr($this->string,$this->pos,1) == '[') {
			$this->pos += 1;
			$result["text"] .= '[';
		}
		else { $_167 = FALSE; break; }
		$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else { $_167 = FALSE; break; }
		$_163 = NULL;
		do {
			$_161 = NULL;
			do {
				$res_56 = $result;
				$pos_56 = $this->pos;
				$_73 = NULL;
				do {
					$stack[] = $result; $result = $this->construct( $matchrule, "Operator" );
					$_62 = NULL;
					do {
						$_60 = NULL;
						do {
							$res_57 = $result;
							$pos_57 = $this->pos;
							if (( $subres = $this->literal( 'instanceof' ) ) !== FALSE) {
								$result["text"] .= $subres;
								$_60 = TRUE; break;
							}
							$result = $res_57;
							$this->pos = $pos_57;
							if (( $subres = $this->literal( '!instanceof' ) ) !== FALSE) {
								$result["text"] .= $subres;
								$_60 = TRUE; break;
							}
							$result = $res_57;
							$this->pos = $pos_57;
							$_60 = FALSE; break;
						}
						while(0);
						if( $_60 === FALSE) { $_62 = FALSE; break; }
						$_62 = TRUE; break;
					}
					while(0);
					if( $_62 === TRUE ) {
						$subres = $result; $result = array_pop($stack);
						$this->store( $result, $subres, 'Operator' );
					}
					if( $_62 === FALSE) {
						$result = array_pop($stack);
						$_73 = FALSE; break;
					}
					$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) { $this->store( $result, $subres ); }
					else { $_73 = FALSE; break; }
					$_70 = NULL;
					do {
						$_68 = NULL;
						do {
							$res_65 = $result;
							$pos_65 = $this->pos;
							$matcher = 'match_'.'StringLiteral'; $key = $matcher; $pos = $this->pos;
							$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
							if ($subres !== FALSE) {
								$this->store( $result, $subres, "Operand" );
								$_68 = TRUE; break;
							}
							$result = $res_65;
							$this->pos = $pos_65;
							$matcher = 'match_'.'UnquotedOperand'; $key = $matcher; $pos = $this->pos;
							$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
							if ($subres !== FALSE) {
								$this->store( $result, $subres, "Operand" );
								$_68 = TRUE; break;
							}
							$result = $res_65;
							$this->pos = $pos_65;
							$_68 = FALSE; break;
						}
						while(0);
						if( $_68 === FALSE) { $_70 = FALSE; break; }
						$_70 = TRUE; break;
					}
					while(0);
					if( $_70 === FALSE) { $_73 = FALSE; break; }
					$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) { $this->store( $result, $subres ); }
					else { $_73 = FALSE; break; }
					$_73 = TRUE; break;
				}
				while(0);
				if( $_73 === TRUE ) { $_161 = TRUE; break; }
				$result = $res_56;
				$this->pos = $pos_56;
				$_159 = NULL;
				do {
					$matcher = 'match_'.'PropertyPath'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) {
						$this->store( $result, $subres, "PropertyPath" );
					}
					else { $_159 = FALSE; break; }
					$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
					if ($subres !== FALSE) { $this->store( $result, $subres ); }
					else { $_159 = FALSE; break; }
					$res_158 = $result;
					$pos_158 = $this->pos;
					$_157 = NULL;
					do {
						$stack[] = $result; $result = $this->construct( $matchrule, "Operator" );
						$_138 = NULL;
						do {
							$_136 = NULL;
							do {
								$res_77 = $result;
								$pos_77 = $this->pos;
								if (( $subres = $this->literal( 'instanceof' ) ) !== FALSE) {
									$result["text"] .= $subres;
									$_136 = TRUE; break;
								}
								$result = $res_77;
								$this->pos = $pos_77;
								$_134 = NULL;
								do {
									$res_79 = $result;
									$pos_79 = $this->pos;
									if (( $subres = $this->literal( '!instanceof' ) ) !== FALSE) {
										$result["text"] .= $subres;
										$_134 = TRUE; break;
									}
									$result = $res_79;
									$this->pos = $pos_79;
									$_132 = NULL;
									do {
										$res_81 = $result;
										$pos_81 = $this->pos;
										$matcher = 'match_'.'PrefixMatchInsensitive'; $key = $matcher; $pos = $this->pos;
										$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
										if ($subres !== FALSE) {
											$this->store( $result, $subres );
											$_132 = TRUE; break;
										}
										$result = $res_81;
										$this->pos = $pos_81;
										$_130 = NULL;
										do {
											$res_83 = $result;
											$pos_83 = $this->pos;
											$matcher = 'match_'.'PrefixMatch'; $key = $matcher; $pos = $this->pos;
											$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
											if ($subres !== FALSE) {
												$this->store( $result, $subres );
												$_130 = TRUE; break;
											}
											$result = $res_83;
											$this->pos = $pos_83;
											$_128 = NULL;
											do {
												$res_85 = $result;
												$pos_85 = $this->pos;
												$matcher = 'match_'.'SuffixMatchInsensitive'; $key = $matcher; $pos = $this->pos;
												$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
												if ($subres !== FALSE) {
													$this->store( $result, $subres );
													$_128 = TRUE; break;
												}
												$result = $res_85;
												$this->pos = $pos_85;
												$_126 = NULL;
												do {
													$res_87 = $result;
													$pos_87 = $this->pos;
													$matcher = 'match_'.'SuffixMatch'; $key = $matcher; $pos = $this->pos;
													$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
													if ($subres !== FALSE) {
														$this->store( $result, $subres );
														$_126 = TRUE; break;
													}
													$result = $res_87;
													$this->pos = $pos_87;
													$_124 = NULL;
													do {
														$res_89 = $result;
														$pos_89 = $this->pos;
														$matcher = 'match_'.'SubstringMatchInsensitivee'; $key = $matcher; $pos = $this->pos;
														$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
														if ($subres !== FALSE) {
															$this->store( $result, $subres );
															$_124 = TRUE; break;
														}
														$result = $res_89;
														$this->pos = $pos_89;
														$_122 = NULL;
														do {
															$res_91 = $result;
															$pos_91 = $this->pos;
															$matcher = 'match_'.'SubstringMatch'; $key = $matcher; $pos = $this->pos;
															$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
															if ($subres !== FALSE) {
																$this->store( $result, $subres );
																$_122 = TRUE; break;
															}
															$result = $res_91;
															$this->pos = $pos_91;
															$_120 = NULL;
															do {
																$res_93 = $result;
																$pos_93 = $this->pos;
																$matcher = 'match_'.'ExactMatchInsensitive'; $key = $matcher; $pos = $this->pos;
																$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																if ($subres !== FALSE) {
																	$this->store( $result, $subres );
																	$_120 = TRUE; break;
																}
																$result = $res_93;
																$this->pos = $pos_93;
																$_118 = NULL;
																do {
																	$res_95 = $result;
																	$pos_95 = $this->pos;
																	$matcher = 'match_'.'ExactMatch'; $key = $matcher; $pos = $this->pos;
																	$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																	if ($subres !== FALSE) {
																		$this->store( $result, $subres );
																		$_118 = TRUE; break;
																	}
																	$result = $res_95;
																	$this->pos = $pos_95;
																	$_116 = NULL;
																	do {
																		$res_97 = $result;
																		$pos_97 = $this->pos;
																		$matcher = 'match_'.'NotEqualMatchInsensitive'; $key = $matcher; $pos = $this->pos;
																		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																		if ($subres !== FALSE) {
																			$this->store( $result, $subres );
																			$_116 = TRUE; break;
																		}
																		$result = $res_97;
																		$this->pos = $pos_97;
																		$_114 = NULL;
																		do {
																			$res_99 = $result;
																			$pos_99 = $this->pos;
																			$matcher = 'match_'.'NotEqualMatch'; $key = $matcher; $pos = $this->pos;
																			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																			if ($subres !== FALSE) {
																				$this->store( $result, $subres );
																				$_114 = TRUE; break;
																			}
																			$result = $res_99;
																			$this->pos = $pos_99;
																			$_112 = NULL;
																			do {
																				$res_101 = $result;
																				$pos_101 = $this->pos;
																				$matcher = 'match_'.'LessThanOrEqualMatch'; $key = $matcher; $pos = $this->pos;
																				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																				if ($subres !== FALSE) {
																					$this->store( $result, $subres );
																					$_112 = TRUE; break;
																				}
																				$result = $res_101;
																				$this->pos = $pos_101;
																				$_110 = NULL;
																				do {
																					$res_103 = $result;
																					$pos_103 = $this->pos;
																					$matcher = 'match_'.'LessThanMatch'; $key = $matcher; $pos = $this->pos;
																					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																					if ($subres !== FALSE) {
																						$this->store( $result, $subres );
																						$_110 = TRUE; break;
																					}
																					$result = $res_103;
																					$this->pos = $pos_103;
																					$_108 = NULL;
																					do {
																						$res_105 = $result;
																						$pos_105 = $this->pos;
																						$matcher = 'match_'.'GreaterThanOrEqualMatch'; $key = $matcher; $pos = $this->pos;
																						$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																						if ($subres !== FALSE) {
																							$this->store( $result, $subres );
																							$_108 = TRUE; break;
																						}
																						$result = $res_105;
																						$this->pos = $pos_105;
																						$matcher = 'match_'.'GreaterThanMatch'; $key = $matcher; $pos = $this->pos;
																						$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
																						if ($subres !== FALSE) {
																							$this->store( $result, $subres );
																							$_108 = TRUE; break;
																						}
																						$result = $res_105;
																						$this->pos = $pos_105;
																						$_108 = FALSE; break;
																					}
																					while(0);
																					if( $_108 === TRUE ) {
																						$_110 = TRUE; break;
																					}
																					$result = $res_103;
																					$this->pos = $pos_103;
																					$_110 = FALSE; break;
																				}
																				while(0);
																				if( $_110 === TRUE ) {
																					$_112 = TRUE; break;
																				}
																				$result = $res_101;
																				$this->pos = $pos_101;
																				$_112 = FALSE; break;
																			}
																			while(0);
																			if( $_112 === TRUE ) {
																				$_114 = TRUE; break;
																			}
																			$result = $res_99;
																			$this->pos = $pos_99;
																			$_114 = FALSE; break;
																		}
																		while(0);
																		if( $_114 === TRUE ) { $_116 = TRUE; break; }
																		$result = $res_97;
																		$this->pos = $pos_97;
																		$_116 = FALSE; break;
																	}
																	while(0);
																	if( $_116 === TRUE ) { $_118 = TRUE; break; }
																	$result = $res_95;
																	$this->pos = $pos_95;
																	$_118 = FALSE; break;
																}
																while(0);
																if( $_118 === TRUE ) { $_120 = TRUE; break; }
																$result = $res_93;
																$this->pos = $pos_93;
																$_120 = FALSE; break;
															}
															while(0);
															if( $_120 === TRUE ) { $_122 = TRUE; break; }
															$result = $res_91;
															$this->pos = $pos_91;
															$_122 = FALSE; break;
														}
														while(0);
														if( $_122 === TRUE ) { $_124 = TRUE; break; }
														$result = $res_89;
														$this->pos = $pos_89;
														$_124 = FALSE; break;
													}
													while(0);
													if( $_124 === TRUE ) { $_126 = TRUE; break; }
													$result = $res_87;
													$this->pos = $pos_87;
													$_126 = FALSE; break;
												}
												while(0);
												if( $_126 === TRUE ) { $_128 = TRUE; break; }
												$result = $res_85;
												$this->pos = $pos_85;
												$_128 = FALSE; break;
											}
											while(0);
											if( $_128 === TRUE ) { $_130 = TRUE; break; }
											$result = $res_83;
											$this->pos = $pos_83;
											$_130 = FALSE; break;
										}
										while(0);
										if( $_130 === TRUE ) { $_132 = TRUE; break; }
										$result = $res_81;
										$this->pos = $pos_81;
										$_132 = FALSE; break;
									}
									while(0);
									if( $_132 === TRUE ) { $_134 = TRUE; break; }
									$result = $res_79;
									$this->pos = $pos_79;
									$_134 = FALSE; break;
								}
								while(0);
								if( $_134 === TRUE ) { $_136 = TRUE; break; }
								$result = $res_77;
								$this->pos = $pos_77;
								$_136 = FALSE; break;
							}
							while(0);
							if( $_136 === FALSE) { $_138 = FALSE; break; }
							$_138 = TRUE; break;
						}
						while(0);
						if( $_138 === TRUE ) {
							$subres = $result; $result = array_pop($stack);
							$this->store( $result, $subres, 'Operator' );
						}
						if( $_138 === FALSE) {
							$result = array_pop($stack);
							$_157 = FALSE; break;
						}
						$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
						$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
						if ($subres !== FALSE) {
							$this->store( $result, $subres );
						}
						else { $_157 = FALSE; break; }
						$_154 = NULL;
						do {
							$_152 = NULL;
							do {
								$res_141 = $result;
								$pos_141 = $this->pos;
								$matcher = 'match_'.'StringLiteral'; $key = $matcher; $pos = $this->pos;
								$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
								if ($subres !== FALSE) {
									$this->store( $result, $subres, "Operand" );
									$_152 = TRUE; break;
								}
								$result = $res_141;
								$this->pos = $pos_141;
								$_150 = NULL;
								do {
									$res_143 = $result;
									$pos_143 = $this->pos;
									$matcher = 'match_'.'NumberLiteral'; $key = $matcher; $pos = $this->pos;
									$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
									if ($subres !== FALSE) {
										$this->store( $result, $subres, "Operand" );
										$_150 = TRUE; break;
									}
									$result = $res_143;
									$this->pos = $pos_143;
									$_148 = NULL;
									do {
										$res_145 = $result;
										$pos_145 = $this->pos;
										$matcher = 'match_'.'BooleanLiteral'; $key = $matcher; $pos = $this->pos;
										$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
										if ($subres !== FALSE) {
											$this->store( $result, $subres, "Operand" );
											$_148 = TRUE; break;
										}
										$result = $res_145;
										$this->pos = $pos_145;
										$matcher = 'match_'.'UnquotedOperand'; $key = $matcher; $pos = $this->pos;
										$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
										if ($subres !== FALSE) {
											$this->store( $result, $subres, "Operand" );
											$_148 = TRUE; break;
										}
										$result = $res_145;
										$this->pos = $pos_145;
										$_148 = FALSE; break;
									}
									while(0);
									if( $_148 === TRUE ) { $_150 = TRUE; break; }
									$result = $res_143;
									$this->pos = $pos_143;
									$_150 = FALSE; break;
								}
								while(0);
								if( $_150 === TRUE ) { $_152 = TRUE; break; }
								$result = $res_141;
								$this->pos = $pos_141;
								$_152 = FALSE; break;
							}
							while(0);
							if( $_152 === FALSE) { $_154 = FALSE; break; }
							$_154 = TRUE; break;
						}
						while(0);
						if( $_154 === FALSE) { $_157 = FALSE; break; }
						$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
						$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
						if ($subres !== FALSE) {
							$this->store( $result, $subres );
						}
						else { $_157 = FALSE; break; }
						$_157 = TRUE; break;
					}
					while(0);
					if( $_157 === FALSE) {
						$result = $res_158;
						$this->pos = $pos_158;
						unset( $res_158 );
						unset( $pos_158 );
					}
					$_159 = TRUE; break;
				}
				while(0);
				if( $_159 === TRUE ) { $_161 = TRUE; break; }
				$result = $res_56;
				$this->pos = $pos_56;
				$_161 = FALSE; break;
			}
			while(0);
			if( $_161 === FALSE) { $_163 = FALSE; break; }
			$_163 = TRUE; break;
		}
		while(0);
		if( $_163 === FALSE) { $_167 = FALSE; break; }
		$matcher = 'match_'.'S'; $key = $matcher; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else { $_167 = FALSE; break; }
		if (substr($this->string,$this->pos,1) == ']') {
			$this->pos += 1;
			$result["text"] .= ']';
		}
		else { $_167 = FALSE; break; }
		$_167 = TRUE; break;
	}
	while(0);
	if( $_167 === TRUE ) { return $this->finalise($result); }
	if( $_167 === FALSE) { return FALSE; }
}

function AttributeFilter__construct (&$result) {
	  $result['Operator'] = NULL;
	  $result['PropertyPath'] = NULL;
	  $result['Identifier'] = NULL;
	}

function AttributeFilter_PropertyPath (&$result, $sub) {
	  $result['PropertyPath'] = $sub['text'];
	  $result['Identifier'] = $result['PropertyPath'];
	}

function AttributeFilter_Operator (&$result, $sub) {
		$result['Operator'] = $sub['text'];
	}

function AttributeFilter_Operand (&$result, $sub) {
		$result['Operand'] = $sub['val'];
	}

/* UnquotedOperand: / [^"'\[\]\s]+ / */
protected $match_UnquotedOperand_typestack = array('UnquotedOperand');
function match_UnquotedOperand ($stack = array()) {
	$matchrule = "UnquotedOperand"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->rx( '/ [^"\'\[\]\s]+ /' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}

function UnquotedOperand__finalise (&$self) {
		$self['val'] = $self['text'];
	}

/* PrefixMatchInsensitive: '^=~' */
protected $match_PrefixMatchInsensitive_typestack = array('PrefixMatchInsensitive');
function match_PrefixMatchInsensitive ($stack = array()) {
	$matchrule = "PrefixMatchInsensitive"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '^=~' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* PrefixMatch: '^=' */
protected $match_PrefixMatch_typestack = array('PrefixMatch');
function match_PrefixMatch ($stack = array()) {
	$matchrule = "PrefixMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '^=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* SuffixMatchInsensitive: '$=~' */
protected $match_SuffixMatchInsensitive_typestack = array('SuffixMatchInsensitive');
function match_SuffixMatchInsensitive ($stack = array()) {
	$matchrule = "SuffixMatchInsensitive"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '$=~' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* SuffixMatch: '$=' */
protected $match_SuffixMatch_typestack = array('SuffixMatch');
function match_SuffixMatch ($stack = array()) {
	$matchrule = "SuffixMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '$=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* SubstringMatchInsensitivee: '*=~' */
protected $match_SubstringMatchInsensitivee_typestack = array('SubstringMatchInsensitivee');
function match_SubstringMatchInsensitivee ($stack = array()) {
	$matchrule = "SubstringMatchInsensitivee"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '*=~' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* SubstringMatch: '*=' */
protected $match_SubstringMatch_typestack = array('SubstringMatch');
function match_SubstringMatch ($stack = array()) {
	$matchrule = "SubstringMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '*=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* ExactMatchInsensitive: '=~' */
protected $match_ExactMatchInsensitive_typestack = array('ExactMatchInsensitive');
function match_ExactMatchInsensitive ($stack = array()) {
	$matchrule = "ExactMatchInsensitive"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '=~' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* ExactMatch: '=' */
protected $match_ExactMatch_typestack = array('ExactMatch');
function match_ExactMatch ($stack = array()) {
	$matchrule = "ExactMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (substr($this->string,$this->pos,1) == '=') {
		$this->pos += 1;
		$result["text"] .= '=';
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* NotEqualMatchInsensitive: '!=~' */
protected $match_NotEqualMatchInsensitive_typestack = array('NotEqualMatchInsensitive');
function match_NotEqualMatchInsensitive ($stack = array()) {
	$matchrule = "NotEqualMatchInsensitive"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '!=~' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* NotEqualMatch: '!=' */
protected $match_NotEqualMatch_typestack = array('NotEqualMatch');
function match_NotEqualMatch ($stack = array()) {
	$matchrule = "NotEqualMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '!=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* LessThanOrEqualMatch: '<=' */
protected $match_LessThanOrEqualMatch_typestack = array('LessThanOrEqualMatch');
function match_LessThanOrEqualMatch ($stack = array()) {
	$matchrule = "LessThanOrEqualMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '<=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* LessThanMatch: '<' */
protected $match_LessThanMatch_typestack = array('LessThanMatch');
function match_LessThanMatch ($stack = array()) {
	$matchrule = "LessThanMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (substr($this->string,$this->pos,1) == '<') {
		$this->pos += 1;
		$result["text"] .= '<';
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* GreaterThanOrEqualMatch: '>=' */
protected $match_GreaterThanOrEqualMatch_typestack = array('GreaterThanOrEqualMatch');
function match_GreaterThanOrEqualMatch ($stack = array()) {
	$matchrule = "GreaterThanOrEqualMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (( $subres = $this->literal( '>=' ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $this->finalise($result);
	}
	else { return FALSE; }
}


/* GreaterThanMatch: '>' */
protected $match_GreaterThanMatch_typestack = array('GreaterThanMatch');
function match_GreaterThanMatch ($stack = array()) {
	$matchrule = "GreaterThanMatch"; $result = $this->construct($matchrule, $matchrule, null);
	if (substr($this->string,$this->pos,1) == '>') {
		$this->pos += 1;
		$result["text"] .= '>';
		return $this->finalise($result);
	}
	else { return FALSE; }
}




	static public function parseFilterGroup($filter) {
		$parser = new FizzleParser($filter);
		$parsedFilter = $parser->match_FilterGroup();
		if ($parser->pos !== strlen($filter)) {
			throw new FizzleException(sprintf('The Selector "%s" could not be parsed. Error at character %d.', $filter, $parser->pos+1), 1327649317);
		}
		return $parsedFilter;
	}

	function BooleanLiteral__finalise(&$self) {
		$self['val'] = strtolower($self['text']) === 'true';
	}

	public function NumberLiteral__finalise(&$self) {
		if (isset($self['dec'])) {
			$self['val'] = (float)($self['text']);
		} else {
			$self['val'] = (integer)$self['text'];
		}
	}
}

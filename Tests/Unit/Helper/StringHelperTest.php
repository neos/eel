<?php
namespace TYPO3\Eel\Tests\Unit;

/*
 * This file is part of the TYPO3.Eel package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Eel\Helper\StringHelper;

/**
 * Tests for StringHelper
 */
class StringHelperTest extends \TYPO3\Flow\Tests\UnitTestCase
{
    public function substrExamples()
    {
        return array(
            'positive start and length lower count' => array('Hello, World!', 7, 5, 'World'),
            'start equal to count' => array('Foo', 3, 42, ''),
            'start greater than count' => array('Foo', 42, 5, ''),
            'start negative' => array('Hello, World!', -6, 5, 'World'),
            'start negative larger than abs(count)' => array('Hello, World!', -42, 5, 'Hello'),
            'start positive and length omitted' => array('Hello, World!', 7, null, 'World!'),
            'start positive and length is 0' => array('Hello, World!', 7, 0, ''),
            'start positive and length is negative' => array('Hello, World!', 7, -1, ''),
            'unicode content is extracted' => array('Öaßaä', 2, 1, 'ß')
        );
    }

    /**
     * @test
     * @dataProvider substrExamples
     */
    public function substrWorks($string, $start, $length, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->substr($string, $start, $length);
        $this->assertSame($expected, $result);
    }

    public function substringExamples()
    {
        return array(
            'start equals end' => array('Hello, World!', 7, 7, ''),
            'end omitted' => array('Hello, World!', 7, null, 'World!'),
            'negative start' => array('Hello, World!', -7, null, 'Hello, World!'),
            'negative end' => array('Hello, World!', 5, -5, 'Hello'),
            'start greater than end' => array('Hello, World!', 5, 0, 'Hello'),
            'start greater than count' => array('Hello, World!', 15, 0, 'Hello, World!'),
            'end greater than count' => array('Hello, World!', 7, 15, 'World!'),
            'unicode content is extracted' => array('Öaßaä', 2, 3, 'ß')
        );
    }

    /**
     * @test
     * @dataProvider substringExamples
     */
    public function substringWorks($string, $start, $end, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->substring($string, $start, $end);
        $this->assertSame($expected, $result);
    }

    public function charAtExamples()
    {
        return array(
            'index in string' => array('Hello, World!', 5, ','),
            'index greater than count' => array('Hello, World!', 42, ''),
            'index negative' => array('Hello, World!', -1, ''),
            'unicode content can be accessed' => array('Öaßaü', 2, 'ß')
        );
    }

    /**
     * @test
     * @dataProvider charAtExamples
     */
    public function charAtWorks($string, $index, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->charAt($string, $index);
        $this->assertSame($expected, $result);
    }

    public function endsWithExamples()
    {
        return array(
            'search matched' => array('To be, or not to be, that is the question.', 'question.', null, true),
            'search not matched' => array('To be, or not to be, that is the question.', 'to be', null, false),
            'search with position' => array('To be, or not to be, that is the question.', 'to be', 19, true),
            'unicode content can be searched' => array('Öaßaü', 'aü', null, true)
        );
    }

    /**
     * @test
     * @dataProvider endsWithExamples
     */
    public function endsWithWorks($string, $search, $position, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->endsWith($string, $search, $position);
        $this->assertSame($expected, $result);
    }

    public function indexOfExamples()
    {
        return array(
            'match at start' => array('Blue Whale', 'Blue', null, 0),
            'no match' => array('Blute', 'Blue', null, -1),
            'from index at start' => array('Blue Whale', 'Whale', 0, 5),
            'from index at begin of match' => array('Blue Whale', 'Whale', 5, 5),
            'from index after match' => array('Blue Whale', 'Whale', 6, -1),
            'empty search' => array('Blue Whale', '', null, 0),
            'empty search with from index' => array('Blue Whale', '', 9, 9),
            'empty search with from index larger than count' => array('Blue Whale', '', 11, 10),
            'case sensitive match' => array('Blue Whale', 'blue', null, -1),
            'unicode content is matched' => array('Öaßaü', 'ßa', null, 2)
        );
    }

    /**
     * @test
     * @dataProvider indexOfExamples
     */
    public function indexOfWorks($string, $search, $fromIndex, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->indexOf($string, $search, $fromIndex);
        $this->assertSame($expected, $result);
    }

    public function lastIndexOfExamples()
    {
        return array(
            'match last occurence' => array('canal', 'a', null, 3),
            'match with from index' => array('canal', 'a', 2, 1),
            'no match with from index too low' => array('canal', 'a', 0, -1),
            'no match' => array('canal', 'x', null, -1),
            'unicode content is matched' => array('Öaßaü', 'a', null, 3)
        );
    }

    /**
     * @test
     * @dataProvider lastIndexOfExamples
     */
    public function lastIndexOfWorks($string, $search, $fromIndex, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->lastIndexOf($string, $search, $fromIndex);
        $this->assertSame($expected, $result);
    }

    public function pregMatchExamples()
    {
        return array(
            'matches' => array('For more information, see Chapter 3.4.5.1', '/(chapter \d+(\.\d)*)/i', array('Chapter 3.4.5.1', 'Chapter 3.4.5.1', '.1'))
        );
    }

    /**
     * @test
     * @dataProvider pregMatchExamples
     */
    public function pregMatchWorks($string, $pattern, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->pregMatch($string, $pattern);
        $this->assertSame($expected, $result);
    }

    public function pregReplaceExamples()
    {
        return array(
            'replace non-alphanumeric characters' => array('Some.String with sp:cial characters', '/[[:^alnum:]]/', '-', 'Some-String-with-sp-cial-characters'),
            'no match' => array('canal', '/x/', 'y', 'canal'),
            'unicode replacement' => array('Öaßaü', '/aßa/', 'g', 'Ögü'),
            'references' => array('2016-08-31', '/([0-9]+)-([0-9]+)-([0-9]+)/', '$3.$2.$1', '31.08.2016')
        );
    }

    /**
     * @test
     * @dataProvider pregReplaceExamples
     */
    public function pregReplaceWorks($string, $pattern, $replace, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->pregReplace($string, $pattern, $replace);
        $this->assertSame($expected, $result);
    }

    public function pregSplitExamples()
    {
        return array(
            'matches' => array('foo bar   baz', '/\s+/', null, array('foo', 'bar', 'baz')),
            'matches with limit' => array('first second third', '/\s+/', 2, array('first', 'second third'))
        );
    }

    /**
     * @test
     * @dataProvider pregSplitExamples
     */
    public function pregMSplitWorks($string, $pattern, $limit, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->pregSplit($string, $pattern, $limit);
        $this->assertSame($expected, $result);
    }

    public function replaceExamples()
    {
        return array(
            'replace' => array('canal', 'ana', 'oo', 'cool'),
            'no match' => array('canal', 'x', 'y', 'canal'),
            'unicode replacement' => array('Öaßaü', 'aßa', 'g', 'Ögü')
        );
    }

    /**
     * @test
     * @dataProvider replaceExamples
     */
    public function replaceWorks($string, $search, $replace, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->replace($string, $search, $replace);
        $this->assertSame($expected, $result);
    }


    public function splitExamples()
    {
        return array(
            'split' => array('My hovercraft is full of eels', ' ', null, array('My', 'hovercraft', 'is', 'full', 'of', 'eels')),
            'NULL separator' => array('The bad parts', null, null, array('The bad parts')),
            'empty separator' => array('Foo', '', null, array('F', 'o', 'o')),
            'empty separator with limit' => array('Foo', '', 2, array('F', 'o'))
        );
    }

    /**
     * @test
     * @dataProvider splitExamples
     */
    public function splitWorks($string, $separator, $limit, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->split($string, $separator, $limit);
        $this->assertSame($expected, $result);
    }

    public function startsWithExamples()
    {
        return array(
            'search matched' => array('To be, or not to be, that is the question.', 'To be', null, true),
            'search not matched' => array('To be, or not to be, that is the question.', 'not to be', null, false),
            'search with position' => array('To be, or not to be, that is the question.', 'that is', 21, true),
            'search with duplicate match' => array('to be, or not to be, that is the question.', 'to be', null, true),
            'unicode content can be searched' => array('Öaßaü', 'Öa', null, true)
        );
    }

    /**
     * @test
     * @dataProvider startsWithExamples
     */
    public function startsWithWorks($string, $search, $position, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->startsWith($string, $search, $position);
        $this->assertSame($expected, $result);
    }

    public function firstLetterToUpperCaseExamples()
    {
        return array(
            'lowercase' => array('foo', 'Foo'),
            'firstLetterUpperCase' => array('Foo', 'Foo')
        );
    }

    /**
     * @test
     * @dataProvider firstLetterToUpperCaseExamples
     */
    public function firstLetterToUpperCaseWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->firstLetterToUpperCase($string);
        $this->assertSame($expected, $result);
    }

    public function firstLetterToLowerCaseExamples()
    {
        return array(
            'lowercase' => array('foo', 'foo'),
            'firstLetterUpperCase' => array('Foo', 'foo')
        );
    }

    /**
     * @test
     * @dataProvider firstLetterToLowerCaseExamples
     */
    public function firstLetterToLowerCaseWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->firstLetterToLowerCase($string);
        $this->assertSame($expected, $result);
    }

    public function toLowerCaseExamples()
    {
        return array(
            'lowercase' => array('Foo bAr BaZ', 'foo bar baz')
        );
    }

    /**
     * @test
     * @dataProvider toLowerCaseExamples
     */
    public function toLowerCaseWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->toLowerCase($string);
        $this->assertSame($expected, $result);
    }

    public function toUpperCaseExamples()
    {
        return array(
            'uppercase' => array('Foo bAr BaZ', 'FOO BAR BAZ')
        );
    }

    /**
     * @test
     * @dataProvider toUpperCaseExamples
     */
    public function toUpperCaseWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->toUpperCase($string);
        $this->assertSame($expected, $result);
    }

    public function isBlankExamples()
    {
        return array(
            'string with whitespace' => array('  	', true),
            'string with characters' => array(' abc ', false),
            'empty string' => array('', true),
            'NULL string' => array(null, true)
        );
    }

    /**
     * @test
     * @dataProvider isBlankExamples
     */
    public function isBlankWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->isBlank($string);
        $this->assertSame($expected, $result);
    }

    public function trimExamples()
    {
        return array(
            'string with whitespace' => array('  	', null, ''),
            'string with characters and whitespace' => array(" Foo Bar \n", null, 'Foo Bar'),
            'empty string' => array('', null, ''),
            'trim with charlist' => array('< abc >', '<>', ' abc ')
        );
    }

    /**
     * @test
     * @dataProvider trimExamples
     */
    public function trimWorks($string, $charlist, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->trim($string, $charlist);
        $this->assertSame($expected, $result);
    }

    public function typeConversionExamples()
    {
        return array(
            'string numeric value' => array('toString', 42, '42'),
            'string true boolean value' => array('toString', true, '1'),
            'string false boolean value' => array('toString', false, ''),

            'integer numeric value' => array('toInteger', '42', 42),
            'integer empty value' => array('toInteger', '', 0),
            'integer invalid value' => array('toInteger', 'x12', 0),

            'float numeric value' => array('toFloat', '3.141', 3.141),
            'float invalid value' => array('toFloat', 'x1.0', 0.0),
            'float exp notation' => array('toFloat', '4.0e8', 4.0e8),

            'boolean true' => array('toBoolean', 'true', true),
            'boolean 1' => array('toBoolean', '1', true),
            'boolean false' => array('toBoolean', 'false', false),
            'boolean 0' => array('toBoolean', '0', false),
            'boolean anything' => array('toBoolean', 'xz', false)
        );
    }

    /**
     * @test
     * @dataProvider typeConversionExamples
     */
    public function typeConversionWorks($method, $string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->$method($string);
        $this->assertSame($expected, $result);
    }

    public function stripTagsExamples()
    {
        return array(
            'strip tags' => array('<a href="#">here</a>', 'here')
        );
    }

    /**
     * @test
     * @dataProvider stripTagsExamples
     */
    public function stripTagsWorks($string, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->stripTags($string);
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function rawUrlEncodeWorks()
    {
        $helper = new StringHelper();
        $result = $helper->rawUrlEncode('&foo|bar');
        $this->assertSame('%26foo%7Cbar', $result);
    }

    public function htmlSpecialCharsExamples()
    {
        return array(
            'encode entities' => array('Foo &amp; Bar', null, 'Foo &amp;amp; Bar'),
            'preserve entities' => array('Foo &amp; <a href="#">Bar</a>', true, 'Foo &amp; &lt;a href="#"&gt;Bar&lt;/a&gt;')
        );
    }

    /**
     * @test
     * @dataProvider htmlSpecialCharsExamples
     */
    public function htmlSpecialCharsWorks($string, $preserveEntities, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->htmlSpecialChars($string, $preserveEntities);
        $this->assertSame($expected, $result);
    }

    public function cropExamples()
    {
        return array(
            'standard options' => array(
                'methodName' => 'crop',
                'maximumCharacters' => 18,
                'suffixString' => '...',
                'text' => 'Kasper Skårhøj implemented the original version of the crop function.',
                'expected' => 'Kasper Skårhøj imp...'
            ),
            'crop at word' => array(
                'methodName' => 'cropAtWord',
                'maximumCharacters' => 18,
                'suffixString' => '...',
                'text' => 'Kasper Skårhøj implemented the original version of the crop function.',
                'expected' => 'Kasper Skårhøj ...'
            ),
            'crop at sentence' => array(
                'methodName' => 'cropAtSentence',
                'maximumCharacters' => 80,
                'suffixString' => '...',
                'text' => 'Kasper Skårhøj implemented the original version of the crop function. But now we are using a TextIterator. Not too bad either.',
                'expected' => 'Kasper Skårhøj implemented the original version of the crop function. ...'
            ),
            'prefixCanBeChanged' => array(
                'methodName' => 'crop',
                'maximumCharacters' => 15,
                'suffixString' => '!',
                'text' => 'Kasper Skårhøj implemented the original version of the crop function.',
                'expected' => 'Kasper Skårhøj !'
            ),
            'subject is not modified if run without options' => array(
                'methodName' => 'crop',
                'maximumCharacters' => null,
                'suffixString' => null,
                'text' => 'Kasper Skårhøj implemented the original version of the crop function.',
                'expected' => 'Kasper Skårhøj implemented the original version of the crop function.'
            )
        );
    }

    /**
     * @test
     * @dataProvider cropExamples
     */
    public function cropWorks($methodName, $maximumCharacters, $suffixString, $text, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->$methodName($text, $maximumCharacters, $suffixString);
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function md5Works()
    {
        $helper = new StringHelper();
        $result = $helper->md5('joh316');
        $this->assertSame('bacb98acf97e0b6112b1d1b650b84971', $result);
    }

    public function lengthExamples()
    {
        return array(
            'null' => array(null, 0),
            'empty' => array('', 0),
            'non-empty' => array('Foo', 3),
            'UTF-8' => array('Cäche Flüsh', 11)
        );
    }

    /**
     * @test
     * @dataProvider lengthExamples
     */
    public function lengthWorks($input, $expected)
    {
        $helper = new StringHelper();
        $result = $helper->length($input);
        $this->assertSame($expected, $result);
    }
}

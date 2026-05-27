<?php

declare(strict_types=1);

namespace Neos\Eel\Tests\Unit;

/*
 * This file is part of the Neos.Eel package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Eel\Helper\JsonHelper;

/**
 * Tests for JsonHelper
 */
final class JsonHelperTest extends \Neos\Flow\Tests\UnitTestCase
{
    public static function stringifyExamples(): \Iterator
    {
        yield 'string value' => [
            'Foo', '"Foo"'
        ];
        yield 'null value' => [
            null, 'null'
        ];
        yield 'numeric value' => [
            42, '42'
        ];
        yield 'array value' => [
            ['Foo', 'Bar'], '["Foo","Bar"]'
        ];
    }

    /**
     * @test
     * @dataProvider stringifyExamples
     */
    public function stringifyWorks($value, $expected)
    {
        $helper = new JsonHelper();
        $result = $helper->stringify($value);
        self::assertEquals($expected, $result);
    }

    public static function parseExamples(): \Iterator
    {
        yield 'string value' => [
            ['"Foo"'], 'Foo'
        ];
        yield 'null value' => [
            ['null'], null
        ];
        yield 'numeric value' => [
            ['42'], 42
        ];
        yield 'array value' => [
            ['["Foo","Bar"]'], ['Foo', 'Bar']
        ];
        yield 'object value is parsed as associative array by default' => [
            ['{"name":"Foo"}'], ['name' => 'Foo']
        ];
        yield 'object value without associative array' => [
            ['{"name":"Foo"}', false], (object)['name' => 'Foo']
        ];
    }

    /**
     * @test
     * @dataProvider parseExamples
     */
    public function parseWorks($arguments, $expected)
    {
        $helper = new JsonHelper();
        $result = $helper->parse(...$arguments);
        self::assertEquals($expected, $result);
    }
}

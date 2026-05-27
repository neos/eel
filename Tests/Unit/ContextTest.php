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

use Neos\Eel\Context;

/**
 * Eel context test
 */
final class ContextTest extends \Neos\Flow\Tests\UnitTestCase
{
    /**
     * Data provider with simple values
     *
     * @return \Iterator<(int | string), mixed>
     */
    public static function simpleValues(): \Iterator
    {
        yield ['Test', 'Test'];
        yield [true, true];
        yield [42, 42];
        yield [7.0, 7.0];
        yield [null, null];
    }

    /**
     * @test
     * @dataProvider simpleValues
     *
     * @param mixed $value
     * @param mixed $expectedUnwrappedValue
     */
    public function unwrapSimpleValues($value, $expectedUnwrappedValue): void
    {
        $context = new Context($value);
        $unwrappedValue = $context->unwrap();
        self::assertSame($expectedUnwrappedValue, $unwrappedValue);
    }

    /**
     * Data provider with array values
     *
     * @return \Iterator<(int | string), mixed>
     */
    public static function arrayValues(): \Iterator
    {
        yield [[], []];
        yield [[1, 2, 3], [1, 2, 3]];
        // Unwrap has to be recursive
        yield [[new Context('Foo')], ['Foo']];
        yield [['arr' => [new Context('Foo')]], ['arr' => ['Foo']]];
    }

    /**
     * @test
     * @dataProvider arrayValues
     *
     * @param mixed $value
     * @param mixed $expectedUnwrappedValue
     */
    public function unwrapArrayValues($value, $expectedUnwrappedValue): void
    {
        $context = new Context($value);
        $unwrappedValue = $context->unwrap();
        self::assertSame($expectedUnwrappedValue, $unwrappedValue);
    }

    /**
     * Data provider with array values
     *
     * @return \Iterator<(int | string), mixed>
     */
    public static function arrayGetValues(): \Iterator
    {
        yield [[], 'foo', null];
        yield [['foo' => 'bar'], 'foo', 'bar'];
        yield [[1, 2, 3], '1', 2];
        yield [['foo' => ['bar' => 'baz']], 'foo', ['bar' => 'baz']];
        yield [new \ArrayObject(['foo' => 'bar']), 'foo', 'bar'];
    }

    /**
     * @test
     * @dataProvider arrayGetValues
     *
     * @param mixed $value
     * @param string $path
     * @param mixed $expectedGetValue
     */
    public function getValueByPathForArrayValues($value, $path, $expectedGetValue): void
    {
        $context = new Context($value);
        $getValue = $context->get($path);
        self::assertSame($getValue, $expectedGetValue);
    }

    /**
     * Data provider with object values
     *
     * @return array
     */
    public static function objectGetValues(): array
    {
        $simpleObject = new \stdClass();
        $simpleObject->foo = 'bar';
        $getterObject = new \Neos\Eel\Tests\Unit\Fixtures\TestObject();
        $getterObject->setProperty('some value');
        $getterObject->setBooleanProperty(true);

        return [
            [$simpleObject, 'bar', null],
            [$simpleObject, 'foo', 'bar'],
            [$getterObject, 'foo', null],
            [$getterObject, 'callMe', null],
            [$getterObject, 'booleanProperty', true]
        ];
    }

    /**
     * @test
     * @dataProvider objectGetValues
     *
     * @param mixed $value
     * @param string $path
     * @param mixed $expectedGetValue
     */
    public function getValueByPathForObjectValues($value, $path, $expectedGetValue): void
    {
        $context = new Context($value);
        $getValue = $context->get($path);
        self::assertSame($getValue, $expectedGetValue);
    }
}

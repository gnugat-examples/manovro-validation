<?php

/*
 * This file is part of the Manovro project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Manovro\Validation\Assertion;

use Manovro\Exception\ValidationFailedException;
use Manovro\Validation\MakeSure;
use PHPUnit\Framework\TestCase;

class IsValidHexadecimalColorTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_3_hexadecimal_digits()
    {
        MakeSure::that('f0f0f0')->isValidHexadecimalColor()->please();

        self::assertTrue(true);
    }

    /**
     * @test
     */
    public function it_is_case_insensitive()
    {
        MakeSure::that('F0f0F0')->isValidHexadecimalColor()->please();

        self::assertTrue(true);
    }

    /**
     * @test
     */
    public function it_cannot_be_any_other_string()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that('red')->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_integer()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(42)->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_float()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(13.37)->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_boolean()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(true)->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_null()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(null)->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_array()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that([])->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_object()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(new \stdClass())->isValidHexadecimalColor()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_callable()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(function () {})->isValidHexadecimalColor()->please();
    }
}

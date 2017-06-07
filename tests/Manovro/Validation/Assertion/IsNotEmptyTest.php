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

class IsNotEmptyTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_a_string_with_at_least_1_character()
    {
        MakeSure::that('Ni!')->isNotEmpty()->please();

        self::assertTrue(true);
    }

    /**
     * @test
     */
    public function it_cannot_be_an_empty_string()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that('')->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_integer()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(42)->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_float()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(13.37)->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_boolean()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(true)->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_null()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(null)->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_array()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that([])->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_object()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(new \stdClass())->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_callable()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(function () {})->isNotEmpty()->please();
    }
}

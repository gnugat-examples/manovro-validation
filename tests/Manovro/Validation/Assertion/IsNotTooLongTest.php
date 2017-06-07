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

class IsNotTooLongTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_a_string_with_less_than_4096_characters()
    {
        MakeSure::that('Ni!')->isNotTooLong()->please();

        self::assertTrue(true);
    }

    /**
     * @test
     */
    public function it_cannot_be_more_than_that()
    {
        $this->expectException(ValidationFailedException::class);

        $tooLongPassword = str_repeat('A', MakeSure::TOO_LONG + 1);
        MakeSure::that($tooLongPassword)->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_integer()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(42)->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_float()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(13.37)->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_boolean()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(true)->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_null()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(null)->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_array()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that([])->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_an_object()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(new \stdClass())->isNotTooLong()->please();
    }

    /**
     * @test
     */
    public function it_cannot_be_a_callable()
    {
        $this->expectException(ValidationFailedException::class);

        MakeSure::that(function () {})->isNotTooLong()->please();
    }
}

<?php

/*
 * This file is part of the Manovro project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\Manovro\Validation;

use Manovro\Exception\ValidationFailedException;
use Manovro\Validation\MakeSure;
use PHPUnit\Framework\TestCase;

class MakeSureTest extends TestCase
{
    /**
     * @test
     */
    public function it_does_not_throw_an_exception_if_value_is_valid()
    {
        MakeSure::that('email@example.com')->isNotEmpty()->please();

        self::assertTrue(true);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_value_is_invalid()
    {
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage(<<<MESSAGE
The following violations were raised:

* Value is empty (it shouldn't be): ""
MESSAGE
        );

        MakeSure::that('')->isNotEmpty()->please();
    }

    /**
     * @test
     */
    public function it_can_apply_many_constraints_on_one_value()
    {
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage(<<<MESSAGE
The following violations were raised:

* Value isn't a valid hexadecimal color (e.g. "f4e3a9"): "With a hareng!"
MESSAGE
        );

        MakeSure::that('With a hareng!')
            ->isNotEmpty()->isValidHexadecimalColor()
            ->please()
        ;
    }

    /**
     * @test
     */
    public function it_can_check_many_values()
    {
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage(<<<MESSAGE
The following violations were raised:

* Value is empty (it shouldn't be): ""
* Value isn't a valid hexadecimal color (e.g. "f4e3a9"): "With a hareng!"
MESSAGE
        );

        MakeSure::that('')->isNotEmpty()
            ->andThat('With a hareng!')->isValidHexadecimalColor()
            ->please()
        ;
    }
}

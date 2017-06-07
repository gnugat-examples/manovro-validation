<?php

/*
 * This file is part of the Manovro project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manovro\Validation;

use Assert\{
    LazyAssertion,
    LazyAssertionException
};
use Manovro\Exception\ValidationFailedException;

class MakeSure
{
    const TOO_LONG = 4096;

    private $lazyAssertion;

    public static function that($value) : MakeSure
    {
        $validate = new self();
        $validate->lazyAssertion->that($value, null);

        return $validate;
    }

    public function andThat($value) : MakeSure
    {
        $this->lazyAssertion->that($value, null);

        return $this;
    }

    /**
     * @throws ValidationFailedException If there are any violation raised
     */
    public function please()
    {
        try {
            $this->lazyAssertion->verifyNow();
        } catch (LazyAssertionException $e) {
            $message = "The following violations were raised:\n\n";
            foreach ($e->getErrorExceptions() as $error) {
                $message .= "* {$error->getMessage()}\n";
            }

            throw new ValidationFailedException(
                $message,
                ValidationFailedException::CODE,
                $e
            );
        }
    }

    public function isNotEmpty() : MakeSure
    {
        $this->lazyAssertion->string()->notEmpty(
            'Value is empty (it shouldn\'t be): ""'
        );

        return $this;
    }

    public function isNotTooLong() : MakeSure
    {
        $this->lazyAssertion->string()->maxLength(
            self::TOO_LONG,
            'Value is too long (more than '.self::TOO_LONG.' characters): "%s"'
        );

        return $this;
    }

    public function isValidHexadecimalColor() : MakeSure
    {
        $this->lazyAssertion->regex(
            '/^[0-9A-F]{6}$/i',
            'Value isn\'t a valid hexadecimal color (e.g. "f4e3a9"): "%s"'
        );

        return $this;
    }

    private function __construct()
    {
        $this->lazyAssertion = new LazyAssertion();
    }
}

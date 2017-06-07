# Manovro - Validation

This package offers the possibility to raise violations when checking that
some values comply to some constraints.

## Usage

Given the following code snippet:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Manovro\Exception\ValidationFailedException;
use Manovro\Validation\MakeSure;

try {
    MakeSure::that('email@example.com')->isNotTooLong()
        ->andThat(23)->isNotEmpty()
        ->andThat('42')->isValidHexadecimalColor()
        ->please()
    ;
} catch (ValidationFailedException $e) {
    echo $e->getMessage();
}
```

Then we should get the following output:

```
The following violations were raised:

* Value "23" is not an integer
* Value "42" is not a valid UUID
```

<?php

declare(strict_types=1);

namespace InsideData\Support;

use InsideData\Support\TypedCollection;

if (! function_exists('typed_collection')) {

    function typed_collection(array|string $accepts) {
        return (new TypedCollection)->accepts($accepts);
    }
}

<?php

namespace Joelwmale\LaravelEncryption\Support;

use Joelwmale\LaravelEncryption\Casts\Date;

class HandleCastableAttributes
{
    public static function handle(array $encryptableCasts, string $attribute, $value)
    {
        $castType = $encryptableCasts[$attribute] ?? null;

        if ($castType === 'date' || $castType === 'datetime') {
            return Date::handle($value);
        }

        throw new \Exception('The cast type "'.$castType.'" is not supported.');
    }
}

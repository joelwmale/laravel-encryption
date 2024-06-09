<?php

namespace Joelwmale\LaravelEncryption\Support;

use Joelwmale\LaravelEncryption\Casts\Date;
use Joelwmale\LaravelEncryption\Casts\Json;

class HandleCastableAttributes
{
    public static function handle(array $encryptableCasts, string $attribute, $value)
    {
        $castType = $encryptableCasts[$attribute] ?? null;

        if (! $castType) {
            return $value;
        }

        if ($castType === 'date' || $castType === 'datetime') {
            return Date::handle($value);
        }

        if ($castType === 'json') {
            return Json::handle($value);
        }

        throw new \Exception('The cast type "'.$castType.'" is not supported.');
    }
}

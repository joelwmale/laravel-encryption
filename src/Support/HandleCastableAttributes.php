<?php

namespace Joelwmale\LaravelEncryption\Support;

class HandleCastableAttributes
{
    public static function handle(array $encryptableCasts, string $attribute, $value)
    {
        $castType = $encryptableCasts[$attribute] ?? null;

        if ($castType === 'datetime') {
            if (class_exists('Carbon\Carbon')) {
                return \Carbon\Carbon::parse($value);
            }

            return new \DateTime($value);
        }

        if ($castType === 'date') {
            if (class_exists('Carbon\Carbon')) {
                return \Carbon\Carbon::parse($value);
            }

            return new \DateTime($value);
        }

        if ($castType === 'time') {
            if (class_exists('Carbon\Carbon')) {
                return \Carbon\Carbon::parse($value);
            }

            return new \DateTime($value);
        }

        return $value;
    }
}

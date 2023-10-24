<?php

namespace Joelwmale\LaravelEncryption\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Joelwmale\LaravelEncryption\LaravelEncryption
 */
class LaravelEncryptionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \VendorName\Skeleton\Skeleton::class;
    }
}

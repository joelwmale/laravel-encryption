# Laravel Encryption

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joelwmale/laravel-encryption.svg?style=flat-square)](https://packagist.org/packages/joelwmale/laravel-encryption)
[![Total Downloads](https://img.shields.io/packagist/dt/joelwmale/laravel-encryption.svg?style=flat-square)](https://packagist.org/packages/joelwmale/laravel-encryption)

A package to easily encrypt & decrypt database data in Laravel using built in Laravel functions.

## Key Features

- Encrypt and decrypt module attributes easily
- Minimal configuration
- Uses in-built Laravel functions for encrypting and decrypting
- Easily select encrypted fields and their casts

## Installation

You can install the package via composer:

```bash
composer require joelwmale/laravel-encryption
```

## Usage

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Joelwmale\LaravelEncryption\Traits\EncryptsAttributes;

class SensitiveModel extends Model
{
    use EncryptsAttributes;

    protected $encryptableAttributes = [
        'field_one',
        'field_two',
        'date_one',
    ];

    protected $encryptableCasts = [
        'date_one' => 'date',
    ];
}
```

## Configuration

### Publshing configuration

The configuration file looks like this:

```php
return [
    'laravel_encryption_enabled' => env('LARAVEL_ENCRYPTION_ENABLED', true),
];
```

If you need to make any changes to the configuration, feel free to publish the configuration file.

```sh
php artisan vendor:publish --provider="Joelwmale\LaravelEncryption\LaravelEncryptionServiceProvider"
```

### Configure Attributes to be Encryped/Decrypted

Add all your database columns that require this functionality into this array.

```php
protected $encryptableAttributes = [
    'field_one',
    'field_two',
    'date_one',
];
```


### Casting Encrypred/Decrypted values

Due to the fact that encryped values can be quite long, you will need to store them as `text` fields, meaning you have to give way to native column types.

Also due to the way Laravel handles casting (and the priority it takes) you cannot right now use native casts with encrypted fields (open to a PR if someone can solve this)

```php
protected $encryptableCasts = [
    'date_one' => 'date',
];
```

#### Supported casts

Not all casts are supported right now, but again, open to PRs to add more casts

- date

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email joel@joelmale.com instead of using the issue tracker.

## Credits

- [Joel Male](https://github.com/joelwmale)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

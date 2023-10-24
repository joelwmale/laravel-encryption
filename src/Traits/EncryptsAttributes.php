<?php

namespace Joelwmale\LaravelEncryption\Traits;

use Illuminate\Support\Facades\Crypt;
use Joelwmale\LaravelEncryption\Support\HandleCastableAttributes;
use Joelwmale\LaravelEncryption\Support\ParseAttributes;

trait EncryptsAttributes
{
    private $encryptionEnabled;

    public function __construct()
    {
        parent::__construct();

        $this->encryptionEnabled = config('laravel_encryption.enabled', true);
    }

    public function getEncryptableAttributes()
    {
        return $this->encryptableAttributes ?? [];
    }

    public static function bootEncryptsAttributes()
    {
        static::saving(function ($model) {
            $model->encryptAttributes();
        });

        static::saved(function ($model) {
            $model->decryptAttributes();
        });

        static::retrieved(function ($model) {
            $model->decryptAttributes();
        });
    }

    public function encryptAttributes()
    {
        if (! $this->encryptionEnabled) {
            return;
        }

        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (! empty($this->$attribute)) {
                $this->$attribute = Crypt::encryptString(
                    ParseAttributes::parse(
                        $this->encryptableCasts ?? [],
                        $attribute,
                        $this->$attribute
                    )
                );
            }
        }
    }

    public function decryptAttributes()
    {
        if (! $this->encryptionEnabled) {
            return;
        }

        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (! empty($this->$attribute) && $this->attributeIsEncrypted($attribute)) {
                $value = Crypt::decryptString($this->$attribute);

                if (! empty($this->encryptableCasts)) {
                    $this->$attribute = HandleCastableAttributes::handle($this->encryptableCasts, $attribute, $value);
                } else {
                    $this->$attribute = $value;
                }
            }
        }
    }

    public function attributeIsEncrypted($attribute)
    {
        try {
            Crypt::decryptString($this->$attribute);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function parseAttribute($attribute)
    {
        $castType = $this->encryptableCasts[$attribute] ?? null;

        if ($this->$attribute instanceof \DateTime && $castType === 'datetime') {
            return $this->$attribute->format('Y-m-d H:i:s');
        }

        if ($this->$attribute instanceof \DateTime && $castType === 'date') {
            return $this->$attribute->format('Y-m-d');
        }

        if ($this->$attribute instanceof \DateTime && $castType === 'time') {
            return $this->$attribute->format('H:i:s');
        }

        if ($this->$attribute instanceof \DateTime) {
            return $this->$attribute->format('Y-m-d H:i:s');
        }

        return $this->$attribute;
    }
}

<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Joelwmale\LaravelEncryption\Traits\EncryptsAttributes;

class TestUserDateCast extends Model
{
    use EncryptsAttributes;
    use HasFactory;

    protected $guarded = [];

    protected $table = 'test_users';

    protected $encryptableAttributes = [
        'date_of_birth',
    ];

    protected $encryptableCasts = [
        'date_of_birth' => 'date',
    ];
}

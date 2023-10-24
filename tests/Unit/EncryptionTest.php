<?php

use Illuminate\Support\Facades\DB;
use Tests\Models\TestUser;
use Tests\Models\TestUserDateCast;

test('it encrypts data', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com.au',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $dbUser = DB::table('test_users')->where('id', $user->id)->first();

    expect($dbUser->date_of_birth)->not->toBe('1990-01-01');
});

test('it decrypts data', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com.au',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $user = TestUser::first();

    expect($user->date_of_birth)->toBe('1990-01-01');
});

test('it doesnt encrypt data when disabled', function () {
    config(['laravel_encryption.enabled' => false]);

    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com.au',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $dbUser = DB::table('test_users')->where('id', $user->id)->first();

    expect($dbUser->date_of_birth)->toBe('1990-01-01');
});

test('it encrypts data with casts (date)', function () {
    $user = TestUserDateCast::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com.au',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $dbUser = DB::table('test_users')->where('id', $user->id)->first();

    expect($dbUser->date_of_birth)->not->toBe('1990-01-01');
});

test('it decrypts data with casts (date)', function () {
    $user = TestUserDateCast::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com.au',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $user = TestUserDateCast::first();

    expect($user->date_of_birth)->toBeInstanceOf(\Carbon\Carbon::class);
    expect($user->date_of_birth->toDateString())->toBe('1990-01-01');
});

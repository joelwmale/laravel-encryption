<?php

use Tests\Models\TestUser;

it('searches encrypted data using whereEncrypted', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::whereEncrypted('date_of_birth', '1992-01-01')->first();

    expect($user->name)->toBe('John Doe');
});

it('searches encrypted data using orWhereEncrypted', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $users = TestUser::whereEncrypted('date_of_birth', '1992-01-01')->orWhereEncrypted('date_of_birth', '1990-01-01')->get();

    expect($users->count())->toBe(2);
});

it('searches encrypted data using whereIn', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $users = TestUser::whereInEncrypted('date_of_birth', ['1992-01-01'])->get();

    expect($users->count())->toBe(1);
});

it('searches encrypted data using orWhereInEncryped', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $users = TestUser::whereInEncrypted('date_of_birth', ['1992-01-01'])->orWhereInEncrypted('date_of_birth', ['1990-01-01'])->get();

    expect($users->count())->toBe(2);
});

it('searches encrypted data using whereNotInEncrypted', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $user = TestUser::whereNotInEncrypted('date_of_birth', ['1992-01-01'])->first();

    expect($user->name)->toBe('Jane Doe');
});

it('orders encrypted data using orderByEncrypted (desc)', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $user = TestUser::orderByEncrypted('date_of_birth', 'desc')->first();

    expect($user->name)->toBe('John Doe');
});

it('orders encrypted data using orderByEncrypted (asc)', function () {
    $user = TestUser::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'date_of_birth' => '1992-01-01',
    ]);

    $user = TestUser::create([
        'name' => 'Jane Doe',
        'email' => 'jane@doe.com',
        'password' => 'password',
        'date_of_birth' => '1990-01-01',
    ]);

    $user = TestUser::orderByEncrypted('date_of_birth', 'asc')->first();

    expect($user->name)->toBe('Jane Doe');
});

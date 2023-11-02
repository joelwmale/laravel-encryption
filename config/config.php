<?php

return [
    /**
     * Enable or disable the encryption.
     */
    'enabled' => env('LARAVEL_ENCRYPTION_ENABLED', true),

    /**
     * The encryption key.
     *
     * Default: your app key.
     */
    'key' => env('LARAVEL_ENCRYPTION_KEY', null),

    /**
     * The encryption cipher.
     *
     * Supports any cipher method supported by openssl_get_cipher_methods().
     *
     * Default: AES-256-CBC.
     */
    'cipher' => env('LARAVEL_ENCRYPTION_CIPHER', 'AES-256-CBC'),
];

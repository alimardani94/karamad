<?php

namespace App\Services\KeyGenerator;

use App\Models\Course\OnlineCourse;

class KeyGenerator implements Generator
{
    public function key(): string
    {
        do {
            $bytes = openssl_random_pseudo_bytes(16);
            $key = bin2hex($bytes);
        } while (OnlineCourse::where('key', $key)->exists());

        return $key;
    }
}

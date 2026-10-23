<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

class MoneyAmount
{
    public static function minor($value): int
    {
        $value = (string) $value;
        if (! preg_match('/^([0-9]{1,9})(?:\.([0-9]{1,2}))?$/', $value, $parts)) {
            throw ValidationException::withMessages(['payment' => 'The configured price is invalid. Please contact support.']);
        }

        return ((int) $parts[1] * 100) + (int) str_pad($parts[2] ?? '', 2, '0');
    }
}

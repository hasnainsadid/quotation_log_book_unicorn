<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(8)
                ->letters()      // requires at least one letter
                ->mixedCase()    // requires uppercase + lowercase
                ->numbers()      // requires at least one number
                ->symbols(),      // requires at least one symbol
            'confirmed',
        ];
    }
}

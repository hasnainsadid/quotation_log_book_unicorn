<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        try {
            Validator::make($input, [
                'password' => $this->passwordRules(),
            ])->validate();
        } catch (ValidationException $e) {
            // প্রথম error মেসেজটা popup-এ দেখাও, তারপর আবার throw করো যাতে ফর্মেও error থাকে
            foreach ($e->validator->errors()->all() as $message) {
        notify()->error($message);
    }
    throw $e;
        }

        try {
            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();
        } catch (\Throwable $e) {
            report($e);
            foreach ($e->validator->errors()->all() as $message) {
        notify()->error($message);
    }
    throw $e;
        }

        notify()->success('Password Reset Successfully');
    }
}
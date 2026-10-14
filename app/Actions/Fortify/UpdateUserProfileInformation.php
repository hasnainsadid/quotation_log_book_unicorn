<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => ['nullable', 'numeric', 'digits_between:10,15'],
            'address' => ['nullable', 'string'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $file = $input['photo'];

            $fileName = uniqid('profile_') . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('backend/img/profile'),
                $fileName
            );

            $user->forceFill([
                'profile_photo_path' => $fileName,
            ])->save();
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'] ?? null,
                'address' => $input['address'] ?? null,
            ])->save();

            notify()->success('Profile updated successfully.');
        }
    }

    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
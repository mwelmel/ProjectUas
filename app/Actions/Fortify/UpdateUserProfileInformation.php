<?php

namespace App\Actions\fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdateUserProfileInformtion;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:225'],
            'username'  => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'email'  => ['required', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
        $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerfiedUser($user, $input);
        } else {
            $user->forceFill([
                'name'  => $input['name'],
                'username'  => $input['username'],
                'email'  => $input['email'],
            ])->save();
        }
    }

    // Update the given verified user's profile information.
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'email_verified_at'  => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
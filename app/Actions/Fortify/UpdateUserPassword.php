<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdateUserPasswords;

class UpdateUserPassword implements UpdateUserPasswords
{
    use PasswordValidationRules;

    // Validate and update the user's password.
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password'  => ['required', 'string'],
            'password'  => $this->passwordRules(),        
        ])->after(function ($validator) use ($user, $input) {
            if (! isset($input['current_passoword']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $user->forceFill([
            'password'  => Hash::make($input['password']),
        ])->save();
    }
}
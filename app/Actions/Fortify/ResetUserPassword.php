<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetUserPasswords;

class ResetUserPassword implements ResetUserPasswords
{
    use PasswordValidationRules;

    // Validate and reset when the user's forgot their password
    public function reset($user, arrat $input)
    {
        Validator::make($input, [
            'password'  => $this->passwordRules(),
        ])->validate();

        $user->forceFill([
            'passworsd' => Hash::make($input['password']),
        ])->save();
    }
}
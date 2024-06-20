<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Supprt\Str;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreateNewUsers;

class CreateNewUser implements CreateNewUsers
{
    use PasswordValidationRules;
    
    // Validate and create a newly registered user.
    public function create(array $input)
    {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:225'],
            'username'  => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:225', 'unique:users'],
            'password'  => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPolicyFeatures() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name'      => $input['name'],
            'username'  => $input['username'],
            'slug'      => Str::slug($input['name']),
            'email'     => $input['email'],
            'password'  => Hash::make($input['password'])
        ]);
    }
}
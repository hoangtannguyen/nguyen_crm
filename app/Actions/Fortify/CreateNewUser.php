<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input) {
        $messages = [
            'name.required'=>__('Please input username!'),
            'name.regex'=>__('This username not match type!'),
            'name.unique'=>__('This username had exist!'),
            'email.required'=>__('Please input your Email!'),
            'email.email'=>__('Please input correct email type!'),
            'email.unique'=>__('This email had exist!'),
        ];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ], $messages)->validate();

        return User::create([
            'name' => $input['name'],
            'displayname' => $input['displayname'],
            'email' => $input['email'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'image' => $input['image'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

<?php

namespace App\Actions\Fortify;

use App\Helper\UsersType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255',Rule::unique('users','email')->where('type',UsersType::Client)],
            'mobile' => [ 'required', 'numeric',Rule::unique('users','mobile')->where('type',UsersType::Client)],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'type' => UsersType::Client,
            'password' => Hash::make($input['password']),
        ]);
    }
}

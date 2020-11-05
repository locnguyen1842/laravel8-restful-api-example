<?php

namespace App\Http\Controllers\Api\Auth;

use libphonenumber\PhoneNumberFormat;

class ApiLoginController extends AuthController
{
    protected $guardName = 'api';

    protected $usernameField = 'phone_number';

    protected $passwordField = 'password';
    
    protected function prepareForValidation($request)
    {
        $request->merge([
            $this->usernameField => phone_number($request->phone_number, PhoneNumberFormat::INTERNATIONAL),
        ]);
    }
}

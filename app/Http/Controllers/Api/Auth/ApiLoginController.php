<?php

namespace App\Http\Controllers\Api\Auth;

use libphonenumber\PhoneNumberFormat;

class ApiLoginController extends AuthController
{
    protected $guardName = 'api';

    //LOGIN AS PHONE NUMBER

    // protected $usernameField = 'phone_number';

    // protected $passwordField = 'password';
    
    // protected function prepareForValidation($request)
    // {
    //     //convert phone_number to international to validate and login
    //     $request->merge([
    //         $this->usernameField => phone_number($request->phone_number, PhoneNumberFormat::INTERNATIONAL),
    //     ]);
    // }

    //END LOGIN AS PHONE NUMBER
}

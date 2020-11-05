<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use libphonenumber\PhoneNumberFormat;
use Spatie\Permission\Models\Role;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email|required|unique:\App\Models\User',
            'phone_number' => 'phone:VN|required|unique:\App\Models\User',
            'password' => 'confirmed|required',
            'role' => 'required|exists:\Spatie\Permission\Models\Role,name|in:' . implode(',', Role::all()->pluck('name')->toArray())
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone_number' => phone_number($this->phone_number, PhoneNumberFormat::INTERNATIONAL),
        ]);
    }
}

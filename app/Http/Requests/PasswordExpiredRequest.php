<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class PasswordExpiredRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class AuthorizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'vo_id' => 'required|string|min:18|max:18',
            'vo_secret' => 'required|string|min:7',
        ];
    }
}

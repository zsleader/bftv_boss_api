<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
            'vo_id' => 'required|string|length:18',
            'vo_secret' => 'required|string',
        ];
    }
}

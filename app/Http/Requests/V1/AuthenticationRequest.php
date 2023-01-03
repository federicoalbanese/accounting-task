<?php

namespace App\Http\Requests\V1;

use App\Constants\RoleConstants;
use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $roles = implode(',', RoleConstants::ROLES);

        return [
            'email' => 'required|string',
            'password' => 'required',
            'role' => 'required|in:' . $roles,
        ];
    }
}

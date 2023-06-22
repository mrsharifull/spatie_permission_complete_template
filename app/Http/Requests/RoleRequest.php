<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'permission' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules['name'] .= '|unique:roles,name';
        } else {
            $id = $this->route('id');
            $rules['name'] .= '|unique:roles,name,' . $id."id";
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'name' => 'Role Name',
            'permission' => 'User Permission',
        ];
    }
}

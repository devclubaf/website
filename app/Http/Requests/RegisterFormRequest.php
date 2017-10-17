<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
class RegisterFormRequest extends FormRequest
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
            'location' => 'required|string|max:255',
            'dob' => 'required|date|before:-15 years',
            'gender' => 'required|string|max:255',
        ];
    }

    public function gender(): string
    {
        return $this->get('gender');
    }

    public function dob(): string
    {
        return $this->get('dob');
    }

    public function location(): string
    {
        return $this->get('location');
    }

}

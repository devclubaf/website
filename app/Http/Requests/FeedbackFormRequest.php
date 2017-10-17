<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Feedback;
class FeedbackFormRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:255',
        ];
    }

    public function email(): string
    {
        return $this->get('email');
    }

    public function message(): string
    {
        return $this->get('message');
    }
}

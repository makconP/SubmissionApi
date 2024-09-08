<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be a string',
            'email.required' => 'Email is required',
            'email.email' => 'Email must comply with the current RFC standard for email',
            'message.required' => 'Message is required',
            'message.string' => 'Message should be a string',
        ];
    }

    public function getName(): string
    {
        return $this->validated('name');
    }

    public function getEmail(): string
    {
        return $this->validated('email');
    }

    public function getMessage(): string
    {
        return $this->validated('message');
    }
}

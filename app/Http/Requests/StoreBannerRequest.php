<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'name' => 'required|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
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
            'name.required' => 'A banner name is required',
            'name.max' => 'The banner name may not be greater than 150 characters',
            'image.required' => 'An image banner is required',
            'image.image' => 'The banner image must be an image',
            'image.mimes' => 'The banner image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'The banner image may not be greater than 2048 kilobytes',
            'status.required' => 'The status for banner is required',
        ];
    }
}

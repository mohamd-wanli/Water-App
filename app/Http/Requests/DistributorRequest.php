<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
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

            'commercial_license'=>'required',
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string|min:6',
            'phone'=>'required|min:10',

        ];
    }
}

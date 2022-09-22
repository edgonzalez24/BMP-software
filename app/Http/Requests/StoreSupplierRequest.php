<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|unique:suppliers', 
            'telephone'  => 'required|string|unique:suppliers', 
            'email'  => 'required|email|unique:suppliers', 
            'active'  => 'required|boolean',
        ];
    }
}
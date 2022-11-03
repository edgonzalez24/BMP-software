<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'type_client_id' => 'required|integer', 
            'zone_id' => 'required|integer', 
            'method_paid_id' => 'required|integer',
            'telephone' => 'string|nullable', 
            'comment' => 'string|nullable', 
            'active' => 'boolean',
        ];
    }
}

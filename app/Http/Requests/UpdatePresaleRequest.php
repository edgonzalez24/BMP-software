<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePresaleRequest extends FormRequest
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
            'total_paid' => 'required',
            'total_pending' => 'required',
            'dispatch_id' => 'required|integer',
            'paid' => 'boolean',
            'client_id' => 'required|integer',
            'user_presale_id' => 'required|integer',
            'user_dispatch_id' => 'integer',
            'method_paid_id' => 'required',
            'total_detail' => 'required'
        ];
    }
}

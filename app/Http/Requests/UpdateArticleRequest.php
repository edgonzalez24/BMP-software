<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'name'  => 'required|string|unique:suppliers,name'.$request->id, 
            'photo'  => '', 
            'comment'  => 'string', 
            'measure_unit_id'  => 'required|boolean',
            'category_id'  => 'required|boolean',
            'active'  => 'boolean',
        ];
    }
}

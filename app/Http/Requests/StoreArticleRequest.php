<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'name'  => 'required|string|unique:articles', 
            'photo'  => 'string', 
            'comment'  => 'string|nullable', 
            'measure_unit_id'  => 'required',
            'category_id'  => 'required',
            'active'  => 'boolean',
        ];
    }
}

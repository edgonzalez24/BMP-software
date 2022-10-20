<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePresaleDetailRequest extends FormRequest
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
            'total_articles' => 'required|integer',
            'dischargued' => 'required|boolean',
            'total' => 'float',
            'article_id' => 'required|integer',
            'presale_id' => 'required|integer',
        ];
    }
}

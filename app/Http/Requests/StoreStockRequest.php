<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
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
            'article_id' => 'required|integer',
            'quantity_items' => 'required|integer',
            'units_for_unit' => 'integer',
            'buy_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'supplier_id' => 'required|integer',
            'measure_unit_id' => 'required|integer',
            'comment' => 'string',
        ];
    }
}

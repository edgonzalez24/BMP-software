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
            'article_id' => 'requerid|integer',
            'quantity_items' => 'requerid|integer',
            'units_for_unit' => 'integer',
            'buy_price' => 'requerid|float',
            'sale_price' => 'float',
            'supplier_id' => 'requerid|integer',
            'measure_unit_id' => 'requerid|integer',
            'comment' => 'string',
        ];
    }
}

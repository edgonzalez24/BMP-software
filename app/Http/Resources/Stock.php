<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Stock extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'article_id' => $this->article->name,
            'quantity_items' => intval($this->quantity_items),
            'units_for_unit' => $this->units_for_unit,
            'buy_price' => $this->buy_price,
            'sale_price' => $this->sale_price,
            'supplier_id' => $this->supplier->name,
            'measure_unit_id' => $this->measure_unit->name,
            /* 'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
            'deleted' => $this->deleted_at->diffForHumans(),
            'created_at' => $this->created_at->format('d-m-y'),
            'updated_at' => $this->updated_at->format('d-m-y'),
            'deleted_at' => $this->deleted_at->format('d-m-y'), */
        ];
    }
}

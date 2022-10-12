<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockDetailArticle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'measure_unit' => $this->measure_unit,
            'active' => $this->active,
            'category' => $this->category,
            'comment' => $this->comment,
            'stock' => $this->countTotalStock($this->stocks)
            /* 'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
            'deleted' => $this->deleted_at->diffForHumans(),
            'created_at' => $this->created_at->format('d-m-y'),
            'updated_at' => $this->updated_at->format('d-m-y'),
            'deleted_at' => $this->deleted_at->format('d-m-y'), */
        ];
    }

    protected function countTotalStock($stock)
    {
        return $stock->pluck('quantity_items')->sum();
    }
}

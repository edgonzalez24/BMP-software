<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PresaleDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        
        return [
            'id' => $this->id,
            'total_articles' => $this->total_articles,
            'dischargued' => $this->dischargued,
            'total' => $this->total,
            'article' => $this->article,
            'presale' => $this->presale,
            /* 'updated' => $this->updated_at->diffForHumans(),
            'deleted' => $this->deleted_at->diffForHumans(),
            'created_at' => $this->created_at->format('d-m-y'),
            'updated_at' => $this->updated_at->format('d-m-y'),
            'deleted_at' => $this->deleted_at->format('d-m-y'), */
        ];
    }
}

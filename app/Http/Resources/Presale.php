<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PresaleDetail;
use App\Http\Resources\Client;

class Presale extends JsonResource
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
            'total_paid' => $this->total_paid,
            'total_pending' => $this->total_pending,
            'total_detail' => $this->total_detail,
            'dispatch' => $this->dispatch,
            'client' =>  Client::collection(array($this->client))[0],
            'method_paid_client' => $this->client->method_paid,
            'user_presale' => $this->user_presale,
            'user_dispatch' => $this->user_dispatch,
            'presale_detail' => PresaleDetail::collection($this->presale_detail),
            'method_paid' => $this->method_paid,
            'paid' => $this->paid,
            'added' => $this->added,
            'created_at' => $this->created_at,
            /* 'updated' => $this->updated_at->diffForHumans(),
            'deleted' => $this->deleted_at->diffForHumans(),
            'created_at' => $this->created_at->format('d-m-y'),
            'updated_at' => $this->updated_at->format('d-m-y'),
            'deleted_at' => $this->deleted_at->format('d-m-y'), */
        ];
    }
}

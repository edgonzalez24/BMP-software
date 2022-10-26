<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type_client_id', 'telephone', 'comment', 'active'
    ];

    /**
     * Get the type_client that owns the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_client()
    {
        return $this->belongsTo(TypeClient::class);
    }
}

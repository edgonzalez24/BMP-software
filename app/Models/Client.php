<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type_client_id', 'zone_id',  'method_paid_id', 'telephone', 'comment', 'active'
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

    /**
     * Get the zone that owns the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Get the method paid that owns the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function method_paid()
    {
        return $this->belongsTo(MethodPaid::class);
    } 
}

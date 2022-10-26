<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    use HasFactory;

    protected $fillable = [        
        'total_paid',
        'total_pending',
        'dispatch_id',
        'paid',
        'client_id',
        'user_presale_id',
        'user_dispatch_id',
        'method_paid_id',
    ];

    /**
     * Get the client that owns the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the user that owns the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_dispatch()
    {
        return $this->belongsTo(User::class, 'user_dispatch_id');
    }

    
    /**
     * Get the user that owns the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_presale()
    {
        return $this->belongsTo(User::class, 'user_presale_id');
    }

    /**
     * Get all of the presale_detail for the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presale_detail()
    {
        return $this->hasMany(PresaleDetail::class);
    }

    /**
     * Get the method_paid that owns the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function method_paid()
    {
        return $this->belongsTo(MethodPaid::class);
    }

    /**
     * Get the user that owns the Presale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class, 'dispatch_id');
    }
}

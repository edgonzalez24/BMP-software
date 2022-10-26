<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'method_paid_id'
    ];

    /**
     * Get the method_paid that owns the TypeClient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function method_paid()
    {
        return $this->belongsTo(MethodPaid::class);
    }
}

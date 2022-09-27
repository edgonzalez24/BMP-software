<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'photo', 
        'comment',
        'measure_unit_id',
        'active'
    ];

    // Un articulo pertenece a una unidad de medida
    /**
     * Get the course that owns the Inscription
     * Una inscripción pertenece a un solo curso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measure_unit()
    {
        return $this->belongsTo(MeasureUnits::class);
    }
}

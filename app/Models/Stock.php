<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'quantity_items',
        'units_for_unit',
        'buy_price',
        'sale_price',
        'supplier_id',
        'measure_unit_id',
        'comment'
    ];

    /**
     * Get the article that owns the Stock
     * Un registro de stock tiene un articulo relacionado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the supplier that owns the Stock
     * Un registro de estock tiene un provider relacionado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the measure_unit that owns the Stock
     * Un registro de estock tiene una unidad de medida relacionado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measure_unit()
    {
        return $this->belongsTo(MeasureUnits::class);
    }
}

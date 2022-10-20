<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [        
        'total_articles',
        'dischargued',
        'total',
        'article_id',
        'presale_id',
    ];

    /**
     * Get the presale that owns the PresaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function presale()
    {
        return $this->belongsTo(Presale::class);
    }

    /**
     * Get the articles that owns the PresaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

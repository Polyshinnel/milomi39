<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceVariant extends Model
{
    protected $fillable = ['price_item_id', 'duration', 'price', 'price_from', 'note', 'sort_order'];

    protected function casts(): array
    {
        return ['price' => 'decimal:2', 'price_from' => 'boolean'];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(PriceItem::class, 'price_item_id');
    }
}

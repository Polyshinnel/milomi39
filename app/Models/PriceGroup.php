<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceGroup extends Model
{
    protected $fillable = ['price_section_id', 'title', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(PriceSection::class, 'price_section_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PriceItem::class)->orderBy('sort_order');
    }
}

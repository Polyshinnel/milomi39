<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceItem extends Model
{
    protected $fillable = [
        'price_section_id', 'price_group_id', 'item_type', 'title', 'description', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(PriceSection::class, 'price_section_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(PriceGroup::class, 'price_group_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(PriceVariant::class)->orderBy('sort_order');
    }
}

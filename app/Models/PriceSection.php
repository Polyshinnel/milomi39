<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceSection extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'table_type', 'home_image', 'home_description',
        'show_on_home', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['show_on_home' => 'boolean', 'is_active' => 'boolean'];
    }

    public function groups(): HasMany
    {
        return $this->hasMany(PriceGroup::class)->orderBy('sort_order');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PriceItem::class)->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

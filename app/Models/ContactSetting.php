<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'working_hours',
        'telegram_url',
        'whatsapp_url',
        'max_url',
        'online_booking_url',
        'latitude',
        'longitude',
    ];

    public static function current(): ?self
    {
        return static::query()->first();
    }

    public function phoneLink(): string
    {
        $digits = preg_replace('/\D+/', '', $this->phone) ?? '';

        if (str_starts_with($digits, '8')) {
            $digits = '7'.substr($digits, 1);
        }

        return '+'.$digits;
    }
}

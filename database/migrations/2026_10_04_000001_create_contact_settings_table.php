<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('address');
            $table->string('phone');
            $table->string('working_hours');
            $table->string('telegram_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('max_url')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });

        DB::table('contact_settings')->insert([
            'id' => 1,
            'address' => 'г. Калининград, ул. Стрелецкая 21А, помещение 1 (ориентир напротив мостика)',
            'phone' => '8 (981) 463-00-11',
            'working_hours' => '10:00 - 20:00 ежедневно',
            'telegram_url' => 'http://t.me/milomibeauty',
            'whatsapp_url' => 'https://wa.me/qr/A2QEYSLWKTPPM1',
            'max_url' => 'https://max.ru/u/f9LHodD0cOJ0ZQphaplXlZ8RAbMbm_jEYKOnT1EJUzZyBpoUBIchRel_i0A',
            'latitude' => 54.718333,
            'longitude' => 20.544165,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};

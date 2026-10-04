<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('special_offers', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('home_image');
            $table->string('home_title');
            $table->text('home_description');
            $table->string('hero_image');
            $table->string('hero_title');
            $table->text('hero_description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('special_offers')->insert([
            [
                'slug' => 'spa-program',
                'home_image' => 'img/candle.svg',
                'home_title' => 'СПА-ПРОГРАММА',
                'home_description' => '500 р. скидка на первое посещение',
                'hero_image' => 'img/special2.webp',
                'hero_title' => 'СПА-ПРОГРАММА',
                'hero_description' => '500 р. скидка на первое посещение',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'laser-hair-removal',
                'home_image' => 'img/body.svg',
                'home_title' => 'ЛАЗЕРНАЯ ЭПИЛЯЦИЯ',
                'home_description' => '-40% на первую процедуру',
                'hero_image' => 'img/special1.webp',
                'hero_title' => 'ЛАЗЕРНАЯ ЭПИЛЯЦИЯ',
                'hero_description' => '-40% на первую процедуру',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('special_offers');
    }
};

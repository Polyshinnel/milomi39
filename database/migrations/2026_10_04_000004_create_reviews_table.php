<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table): void {
            $table->id();
            $table->string('image');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['is_active', 'sort_order']);
        });

        $now = now();
        $reviews = [];

        for ($order = 1; $order <= 15; $order++) {
            $legacyPath = "img/reviews/{$order}.webp";
            $storedPath = "reviews/legacy-{$order}.webp";

            if (file_exists(public_path($legacyPath))) {
                Storage::disk('public')->put($storedPath, file_get_contents(public_path($legacyPath)));
                $image = $storedPath;
            } else {
                $image = $legacyPath;
            }

            $reviews[] = [
                'image' => $image,
                'sort_order' => $order,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('reviews')->insert($reviews);
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

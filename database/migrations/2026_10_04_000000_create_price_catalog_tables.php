<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_sections', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('table_type', 40)->default('service_time_price');
            $table->string('home_image')->nullable();
            $table->text('home_description')->nullable();
            $table->boolean('show_on_home')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('price_groups', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('price_section_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('price_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('price_section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('price_group_id')->nullable()->constrained()->nullOnDelete();
            $table->string('item_type', 24)->default('service');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['price_section_id', 'sort_order']);
        });

        Schema::create('price_variants', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('price_item_id')->constrained()->cascadeOnDelete();
            $table->string('duration')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('price_from')->default(false);
            $table->string('note')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_variants');
        Schema::dropIfExists('price_items');
        Schema::dropIfExists('price_groups');
        Schema::dropIfExists('price_sections');
    }
};

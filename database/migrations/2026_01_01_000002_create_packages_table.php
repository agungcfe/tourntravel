<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('duration_days')->default(1);
            $table->unsignedSmallInteger('duration_nights')->default(0);
            $table->unsignedBigInteger('price');           // harga dalam Rupiah
            $table->unsignedBigInteger('discount_price')->nullable();
            $table->unsignedSmallInteger('max_people')->default(10);
            $table->string('short_description', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('itinerary')->nullable();          // satu hari per baris
            $table->text('includes')->nullable();           // satu item per baris
            $table->text('excludes')->nullable();           // satu item per baris
            $table->string('image')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

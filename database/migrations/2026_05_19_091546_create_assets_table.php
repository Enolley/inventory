<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {

            $table->id();

            // BASIC INFO
            $table->string('name');

            $table->string('serial_number')->nullable();

            $table->string('tag_number')->unique();

            // FINANCIALS
            $table->decimal('buying_price', 15, 2)->default(0);

            $table->decimal('depreciation_rate', 5, 2)
                ->default(0);

            $table->decimal('current_price', 15, 2)
                ->default(0);

            // LOCATION
            $table->foreignId('assigned_location_id')
                ->nullable()
                ->constrained('locations')
                ->nullOnDelete();

            $table->boolean('is_transferred')
                ->default(false);

            $table->foreignId('current_location_id')
                ->nullable()
                ->constrained('locations')
                ->nullOnDelete();

            // STATUS
            $table->boolean('is_faulty')
                ->default(false);

            $table->string('status')
                ->default('active');

            // DATES
            $table->date('date_bought')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
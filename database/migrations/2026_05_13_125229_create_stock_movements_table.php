<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('inventory_item_id')
                ->constrained()
                ->cascadeOnDelete();

            // ISSUE DETAILS
            $table->integer('quantity_issued');

            // WHO REQUESTED / RECEIVED
            $table->string('issued_to');

            // WHO ISSUED
            $table->foreignId('issued_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // PURPOSE / COMMENTS
            $table->text('purpose')->nullable();

            // LOCATION/DEPARTMENT
            $table->string('department')->nullable();

            // DATE
            $table->timestamp('issued_at')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
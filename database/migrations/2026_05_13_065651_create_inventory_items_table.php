<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {

            $table->id();

            // ITEM INFO
            $table->string('item_name');

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();

            // PURCHASE
            $table->integer('quantity_bought');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('total_price', 12, 2);

            // RECEIVING (DIFFERENT FIELD)
            $table->integer('quantity_received')->default(0);
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('date_received')->nullable();

            // STOCK CONTROL
            $table->integer('stock_balance')->default(0);

            // TRACKING (SEPARATE FIELDS AS REQUESTED)
            $table->text('serial_numbers')->nullable();
            $table->text('tag_numbers')->nullable();

            // EXTRA
            $table->text('comments')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
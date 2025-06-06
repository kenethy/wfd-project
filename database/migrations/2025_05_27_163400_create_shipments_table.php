<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('tracking_number')->unique();
            $table->string('courier_name'); // JNE, J&T Express, SiCepat, Pos Indonesia
            $table->string('courier_code'); // jne, jnt, sicepat, pos
            $table->string('service_type'); // REG, YES, OKE, etc.
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('weight', 8, 2); // in kg
            $table->string('origin_city');
            $table->string('destination_city');
            $table->integer('estimated_days');
            $table->date('estimated_delivery_date');
            $table->enum('status', [
                'pending',
                'picked_up',
                'in_transit',
                'out_for_delivery',
                'delivered',
                'failed',
                'returned'
            ])->default('pending');
            $table->json('tracking_history')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('delivery_notes')->nullable();
            $table->string('recipient_name');
            $table->text('recipient_address');
            $table->string('recipient_phone');
            $table->timestamps();
        });
    }

    /**
     * Run the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

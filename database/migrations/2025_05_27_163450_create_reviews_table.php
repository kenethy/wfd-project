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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->unsigned()->comment('1-5 star rating');
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->json('images')->nullable()->comment('Review images uploaded by customer');
            $table->boolean('is_verified_purchase')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_helpful')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->integer('not_helpful_count')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');

            // Seller response
            $table->text('seller_response')->nullable();
            $table->timestamp('seller_response_at')->nullable();
            $table->foreignId('seller_response_by')->nullable()->constrained('users')->onDelete('set null');

            // Review quality metrics
            $table->json('quality_metrics')->nullable()->comment('Detailed ratings for different aspects');
            $table->boolean('would_recommend')->nullable();
            $table->string('customer_name')->nullable()->comment('Display name for review');
            $table->boolean('is_anonymous')->default(false);

            $table->timestamps();

            // Indexes for performance
            $table->index(['product_id', 'status']);
            $table->index(['user_id', 'created_at']);
            $table->index(['rating', 'created_at']);
            $table->unique(['user_id', 'order_item_id']); // One review per order item
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

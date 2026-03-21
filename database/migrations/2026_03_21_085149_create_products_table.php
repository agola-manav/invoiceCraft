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
        Schema::create('products', function (Blueprint $table) {
             $table->id();

            $table->unsignedBigInteger('user_id')->index();

            $table->string('name')->index();
            $table->string('unit');

            $table->string('hsn_code')->nullable()->index();
            $table->decimal('gst_percent', 5, 2)->default(0); // GST %

            $table->decimal('price', 12, 2);

            $table->enum('item_type', ['goods', 'service'])->index();

            $table->tinyInteger('status')
              ->default(1)
              ->comment('1 = active, 0 = inactive');

            $table->timestamps();
            $table->softDeletes();

            // Foreign Key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Composite Index (useful for search/filter)
            $table->index(['user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

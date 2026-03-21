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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();

            // Invoice Fields
            $table->text('invoice_terms')->nullable();
            $table->text('invoice_remarks')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->unsignedBigInteger('invoice_counter')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexing
            $table->index('user_id');
            $table->index('company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};

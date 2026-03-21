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
        Schema::create('quotation_settings', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();

            // Quotation Fields
            $table->text('quotation_terms')->nullable();
            $table->text('quotation_remarks')->nullable();
            $table->string('quotation_prefix')->nullable();
            $table->unsignedBigInteger('quotation_counter')->default(0);

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
        Schema::dropIfExists('quotation_settings');
    }
};

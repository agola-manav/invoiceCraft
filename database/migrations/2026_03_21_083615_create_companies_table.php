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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // User relation
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic Info
            $table->string('name');
            $table->string('phone_number', 20);
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('gst_number', 30)->nullable();

            // Address Info
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode', 10)->nullable();

            // Files
            $table->string('logo')->nullable();
            $table->string('signature')->nullable();

            $table->tinyInteger('status')
              ->default(1)
              ->comment('1 = active, 0 = inactive');

            $table->timestamps();
            $table->softDeletes();

            // Indexing
            $table->index('user_id');
            $table->index('name');
            $table->index('phone_number');
            $table->index('email');
            $table->index('gst_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

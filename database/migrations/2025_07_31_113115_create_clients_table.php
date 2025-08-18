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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('commercial_number')->nullable();
            $table->boolean('status')->default(1);
            $table->string('commercial_register')->nullable();
            $table->string('personal_id')->nullable();
            $table->string('national_address')->nullable();
            $table->string('IBAN_number')->nullable();
            $table->enum('type', ['individual', 'company'])->default('company');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

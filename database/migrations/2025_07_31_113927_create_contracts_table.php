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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->string('contract_number')->unique();
            $table->enum('type', ['Pest Control', 'Agricultural', 'Industrial', 'Other']);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_value', 15, 2)->default(0);
            $table->unsignedInteger('visits');
            $table->enum('payment_terms', ['monthly', 'quarterly', 'annual', 'custom'])->default('monthly');
            $table->text('terms_and_conditions')->nullable();
            $table->string('note')->nullable();
            $table->enum('status', ['new', 'active', 'expired', 'terminated'])->default('new');
            $table->foreignId('operated_by')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

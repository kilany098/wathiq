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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('expense_categories');
            $table->foreignId('contract_id')->nullable()->constrained('contracts');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->string('expense_number')->unique();
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->text('description');
            $table->enum('payment_method', ['cash', 'bank_transfer', 'cheque', 'credit_card'])->default('cash');
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->string('infestation');
            $table->enum('intensity', ['Low', 'Medium', 'High']);
            $table->text('sprayed_places');
            $table->foreignId('order_id')->constrained('work_orders');
            $table->text('signature');
            $table->enum('evaluation', ['Weak', 'Good', 'Excellent']);
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

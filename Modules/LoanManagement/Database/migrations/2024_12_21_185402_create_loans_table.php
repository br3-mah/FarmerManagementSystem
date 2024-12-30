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
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('farmer_id');
            $table->string('loan_type')->nullable();
            $table->decimal('loan_amount', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('repayment_duration'); // In months
            $table->enum('status', ['pending', 'approved', 'rejected', 'repaid'])->default('pending');
            $table->date('approved_at')->nullable();
            $table->date('repaid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

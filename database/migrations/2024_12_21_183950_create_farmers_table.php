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
        Schema::create('farmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable(); // Name of the farm
            $table->string('farm_name')->nullable(); // Name of the farm
            $table->text('farm_address')->nullable(); // Address of the farm
            $table->decimal('farm_size', 8, 2)->nullable(); // In acres or hectares
            $table->string('type_of_farming')->nullable(); // Livestock, Crop, Mixed, etc.
            $table->string('mobile_money_number')->nullable(); // For payments or loans
            $table->string('bank_account_number')->nullable(); // For payments or loans
            $table->string('bank_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};

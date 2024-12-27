<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('loan_amount', 15, 2);  // Loan amount
            $table->decimal('interest_rate', 5, 2); // Interest rate
            $table->integer('repayment_duration');   // Repayment duration (in months or years)
            $table->enum('status', ['pending', 'approved', 'rejected', 'repaid'])->default('pending'); // Include 'repaid'
            $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade'); // foreign key to farmers table with cascade on delete
            $table->timestamps(); // Created at and updated at timestamps
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


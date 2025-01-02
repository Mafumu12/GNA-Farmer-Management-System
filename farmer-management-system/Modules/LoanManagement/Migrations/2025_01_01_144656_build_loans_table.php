<?php
// Migration for LoanManagement module
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuildLoansTable extends Migration
{
    public function up()
    {
        Schema::connection('loan_management')->create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('loan_amount', 15, 2);  // Loan amount
            $table->decimal('interest_rate', 5, 2); // Interest rate
            $table->integer('repayment_duration');   // Repayment duration (in months or years)
            $table->enum('status', ['pending', 'approved', 'rejected', 'repaid'])->default('pending'); // Include 'repaid'
            $table->unsignedBigInteger('farmer_id'); // Explicitly define the farmer_id column type
 
            $table->foreign('farmer_id')->references('id')->on('farmer_management_system.farmers');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::connection('loan_management')->dropIfExists('loans');
    }
}

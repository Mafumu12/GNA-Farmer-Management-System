<?php

namespace Modules\LoanManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Farmer;  // Import Farmer model from the main project

class Loan extends Model
{
    use HasFactory;
    
    protected $connection = 'loan_management'; // Specify the custom database connection
    protected $fillable = [
        'loan_amount',
        'interest_rate',
        'repayment_duration',
        'farmer_id',
        'status',
    ];

    /**
     * Get the farmer that owns the loan.
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }
}

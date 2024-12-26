<?php

namespace Modules\LoanManagement\Controllers;

use App\Http\Controllers\Controller;

class LoanManagementController extends Controller
{
    public function index()
    {
        return view('LoanManagement::index');
    }
}
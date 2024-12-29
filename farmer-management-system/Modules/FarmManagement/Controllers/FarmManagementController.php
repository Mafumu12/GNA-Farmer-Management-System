<?php

namespace Modules\FarmManagement\Controllers;

use App\Http\Controllers\Controller;

class FarmManagementController extends Controller
{
    public function index()
    {
        return view('FarmManagement::index');
    }
}
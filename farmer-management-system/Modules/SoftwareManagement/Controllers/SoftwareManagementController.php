<?php

namespace Modules\SoftwareManagement\Controllers;

use App\Http\Controllers\Controller;

class SoftwareManagementController extends Controller
{
    public function index()
    {
        return view('SoftwareManagement::index');
    }
}
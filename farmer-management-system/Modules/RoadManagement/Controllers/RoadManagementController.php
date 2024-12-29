<?php

namespace Modules\RoadManagement\Controllers;

use App\Http\Controllers\Controller;

class RoadManagementController extends Controller
{
    public function index()
    {
        return view('RoadManagement::index');
    }
}
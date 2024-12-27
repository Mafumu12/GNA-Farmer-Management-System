<?php

namespace Modules\ProjectManagement\Controllers;

use App\Http\Controllers\Controller;

class ProjectManagementController extends Controller
{
    public function index()
    {
        return view('ProjectManagement::index');
    }
}
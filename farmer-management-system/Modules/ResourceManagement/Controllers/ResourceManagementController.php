<?php

namespace Modules\ResourceManagement\Controllers;

use App\Http\Controllers\Controller;

class ResourceManagementController extends Controller
{
    public function index()
    {
        return view('ResourceManagement::index');
    }
}
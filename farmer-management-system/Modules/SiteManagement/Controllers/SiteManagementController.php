<?php

namespace Modules\SiteManagement\Controllers;

use App\Http\Controllers\Controller;

class SiteManagementController extends Controller
{
    public function index()
    {
        return view('SiteManagement::index');
    }
}
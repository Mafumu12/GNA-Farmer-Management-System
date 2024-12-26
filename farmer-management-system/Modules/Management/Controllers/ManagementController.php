<?php

namespace Modules\Management\Controllers;

use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function index()
    {
        return view('Management::index');
    }
}
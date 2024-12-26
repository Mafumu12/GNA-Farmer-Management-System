<?php

namespace Modules\PeopleManagement\Controllers;

use App\Http\Controllers\Controller;

class PeopleManagementController extends Controller
{
    public function index()
    {
        return view('PeopleManagement::index');
    }
}
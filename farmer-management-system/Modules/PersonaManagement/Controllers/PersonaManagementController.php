<?php

namespace Modules\PersonaManagement\Controllers;

use App\Http\Controllers\Controller;

class PersonaManagementController extends Controller
{
    public function index()
    {
        return view('PersonaManagement::index');
    }
}
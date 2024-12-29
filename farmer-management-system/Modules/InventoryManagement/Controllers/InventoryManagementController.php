<?php

namespace Modules\InventoryManagement\Controllers;

use App\Http\Controllers\Controller;

class InventoryManagementController extends Controller
{
    public function index()
    {
        return view('InventoryManagement::index');
    }
}
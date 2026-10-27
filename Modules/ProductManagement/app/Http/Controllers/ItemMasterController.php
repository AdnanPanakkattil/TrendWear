<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productmanagement::item_master');
    }

    public function create()
    {
        return view('productmanagement::add_item_master');
    }
}

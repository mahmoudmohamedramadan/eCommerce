<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;

class WorkersOfStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        $workers = array();

        foreach ($store->workers as $worker) {
            array_push($workers, $worker);
        }

        return view('admin.worker.index', compact('workers'));
    }
}

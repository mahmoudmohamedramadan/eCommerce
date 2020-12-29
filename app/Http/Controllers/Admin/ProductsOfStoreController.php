<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;

class ProductsOfStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        $products = array();

        foreach ($store->products as $product) {
            array_push($products, $product);
        }

        return view('admin.products.index', compact('products'));
    }
}

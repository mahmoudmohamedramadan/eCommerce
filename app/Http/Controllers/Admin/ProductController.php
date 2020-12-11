<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Store;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get();
        $stores = Store::get();

        return view('admin.products.create', compact('companies', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $photoName = savePhoto('photo', $request->photo, 'assets/images/product');
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'store_id' => session()->get('store_id'),
                'minimum_quantity' => session()->get('minimum_quantity'),
                'company_id' => $request->company_id,
                'total_quantity' => $request->total_quantity,
                'used_quantity' => $request->used_quantity,
                'stored_quantity' => $request->stored_quantity,
                'photo' => $photoName
            ]);
            DB::commit();

            session()->flash('success', __('translate.saved_success'));
            return redirect()->route('products.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.saved_error'));
            return redirect()->route('products.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $stores = Store::get();
        $companies = Company::get();

        return view('admin.products.edit', compact('product', 'stores', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            if (deletePhoto('photo', $product, 'assets/images/product/') or $request->photo) {
                //save photo after delete old one
                $photoName = savePhoto('photo', $request->photo, 'assets/images/product');
                //update photo name in DB
                $product->update([
                    'photo' => $photoName
                ]);
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'store_id' => session()->get('store_id'),
                'minimum_quantity' => session()->get('minimum_quantity'),
                'company_id' => $request->company_id,
                'total_quantity' => $request->total_quantity,
                'used_quantity' => $request->used_quantity,
                'stored_quantity' => $request->stored_quantity,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('products.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.updated_error'));
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        try {
            DB::beginTransaction();
            deletePhoto('photo', $product, 'assets/images/product/');
            $product->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('products.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('products.index');;
        }
    }

    public function getModalValue()
    {
        if (!request()->get('store_id')) {
            return response()->json([
                'success' => false,
                'error_store_msg' => __('translate.store name field is required')
            ]);
        }
        if (!request()->get('minimum_quantity')) {
            return response()->json([
                'success' => false,
                'error_min_msg' => __('translate.minimum quantity field is required')
            ]);
        }
        if (!is_numeric(request()->get('minimum_quantity'))) {
            return response()->json([
                'success' => false,
                'error_min_msg' => __('translate.minimum quantity must be a number')
            ]);
        }

        session()->flash('store_id', request()->get('store_id'));
        session()->flash('minimum_quantity', request()->get('minimum_quantity'));
        return response()->json([
            'success' => true
        ]);
    }
}

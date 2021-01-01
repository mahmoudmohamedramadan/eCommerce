<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
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

        return view('admin.store_products.index', compact('products'))->with('store_id', $store->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Store  $store
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Store $store, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update([
                'minimum_used' => floatval($product->total_quantity) - floatval(request()->get('minimum_used')),
                'minimum_stored' => request()->get('minimum_stored')
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('stores.products.index', $store->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('success', __('translate.updated_error'));
            return redirect()->route('stores.products.index', $store->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('stores.products.index', $store->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('stores.products.index', $store->id);;
        }
    }

    /**
     *
     * Check values in the modal and return ajax respons
     * @return \Illuminate\Http\Response
     */
    public function checkQuantity()
    {
        try {
            if (!request()->get('new_stored_quantity')) {
                return response()->json([
                    'success' => false,
                    'error_stored_msg' => __('translate.stored_quantity_field_is_required')
                ]);
            }
            if (!is_numeric(request()->get('new_stored_quantity'))) {
                return response()->json([
                    'success' => false,
                    'error_stored_msg' => __('translate.stored_quantity_must_be_a_number')
                ]);
            }

            if (request()->filled('old_stored_quantity')) {
                $oldStoredQuantityValue = floatval(request()->get('old_stored_quantity'));
                $newStoredQuantityValue = floatval(request()->get('new_stored_quantity'));

                if ($oldStoredQuantityValue < $newStoredQuantityValue) {
                    return response()->json([
                        'success' => false,
                        'error_stored_msg' => __('translate.new_stored_quantity_must_be_less_than_or_equal_old_stored_quantity')
                    ]);
                }
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}

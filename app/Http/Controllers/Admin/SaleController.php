<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Traits\SaleTrait;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
    use SaleTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $saleDataArray = $this->getSaleData($request);

        try {
            $saleData = [
                'product_name' => $saleDataArray[0],
                'quantity' => $saleDataArray[1],
                'once_price' => $saleDataArray[2],
                'total_price' => $request->total_price,
            ];

            DB::beginTransaction();
            Sale::create($saleData);
            DB::commit();

            session()->flash('success', __('translate.saved_success'));
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.saved_error'));
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $products = Product::all();

        return view('admin.sales.edit', compact('sale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        $saleDataArray = $this->getSaleData($request);

        try {
            DB::beginTransaction();
            $sale->update([
                'product_name' => $saleDataArray[0],
                'quantity' => $saleDataArray[1],
                'once_price' => $saleDataArray[2],
                'total_price' => $request->total_price,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.updated_error'));
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        try {
            DB::beginTransaction();
            $sale->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('sales.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('success', __('translate.deleted_error'));
            return redirect()->route('sales.index');
        }
    }

    /**
     *
     * Get sale's products fields
     * @return \Illuminate\Http\Response
     */
    public function getSalesField()
    {
        $products = Product::get();

        $salesFieldsView = view(
            'admin.sales.getCreateSalesField',
            ['products' => $products, 'id' => request()->get('rowCount')]
        )
            ->render();

        return response()->json([
            'success' => true,
            'salesFieldsView' => $salesFieldsView
        ]);
    }

    /**
     *
     * Check quantity of product
     */
    public function checkProductQuantity()
    {
        $productName = request()->get('product_name');
        $saleProductQuantity = request()->get('quantity');

        $productTotalQuantity = Product::where('name', $productName)
            ->get('used_quantity');

        if (floatval($saleProductQuantity) < floatval($productTotalQuantity[0]['used_quantity'])) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('translate.maximum_quantity_of') . $productName . __('translate.is') . $productTotalQuantity[0]['used_quantity']
        ]);
    }
}

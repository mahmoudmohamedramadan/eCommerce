<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
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
        $product_name = '';
        $quantity = '';
        $once_price = '';

        foreach ($request->input('product_name') as $index => $value) {
            if (count($request->input('product_name')) - 1 != $index) $product_name .=  $value . "\n";
            else $product_name .=  $value;
        }

        foreach ($request->input('quantity') as $index => $value) {
            if (count($request->input('quantity')) - 1 != $index) $quantity .=  $value . "\n";
            else $quantity .=  $value;
        }

        foreach ($request->input('once_price') as $index => $value) {
            if (count($request->input('once_price')) - 1 != $index) $once_price .=  $value . "\n";
            else $once_price .=  $value;
        }
        try {
            $saleData = [
                'product_name' => $product_name,
                'quantity' => $quantity,
                'once_price' => $once_price,
                'total_price' => $request->total_price,
            ];

            DB::beginTransaction();
            Sale::create($saleData);
            DB::commit();

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('admin.sales.pdf', ['saleData' => $saleData]);
            session()->flash('success', __('translate.saved_success'));
            return $pdf->download('sale_' . $saleData['product_name'] . '.pdf');
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
        $product_name = '';
        $quantity = '';
        $once_price = '';

        foreach ($request->input('product_name') as $index => $value) {
            if (count($request->input('product_name')) - 1 != $index) $product_name .=  $value . "\n";
            else $product_name .=  $value;
        }

        foreach ($request->input('quantity') as $index => $value) {
            if (count($request->input('quantity')) - 1 != $index) $quantity .=  $value . "\n";
            else $quantity .=  $value;
        }

        foreach ($request->input('once_price') as $index => $value) {
            if (count($request->input('once_price')) - 1 != $index) $once_price .=  $value . "\n";
            else $once_price .=  $value;
        }

        try {
            DB::beginTransaction();
            $sale->update([
                'product_name' => $product_name,
                'quantity' => $quantity,
                'once_price' => $once_price,
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
}

<?php

namespace App\Traits;

use App\Models\Product;

trait SaleTrait
{

    /**
     *
     * Get sale data from request then push them into array
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function getSaleData($request)
    {
        $saleDataArray = array();
        $productName = '';
        $quantity = '';
        $oncePrice = '';

        foreach ($request->input('product_name') as $index => $value) {
            $product = Product::where('name', $value)->get();
            if (isset($product)) {
                $saleQuantity = $request->input('quantity')[$index];
                if ($request->routeIs('sales.store')) {
                    Product::where('name', $value)->update([
                        'used_quantity' => floatval($product[0]['used_quantity']) - floatval($saleQuantity)
                    ]);
                } else {
                    Product::where('name', $value)->update([
                        'used_quantity' => floatval($product[0]['total_quantity']) - floatval($product[0]['stored_quantity']) - floatval($saleQuantity)
                    ]);
                }
            }

            if (count($request->input('product_name')) - 1 != $index) $productName .=  $value . "\n";
            else $productName .=  $value;
        }

        foreach ($request->input('quantity') as $index => $value) {
            if (count($request->input('quantity')) - 1 != $index) $quantity .=  $value . "\n";
            else $quantity .=  $value;
        }

        foreach ($request->input('once_price') as $index => $value) {
            if (count($request->input('once_price')) - 1 != $index) $oncePrice .=  $value . "\n";
            else $oncePrice .=  $value;
        }

        array_push($saleDataArray, $productName, $quantity, $oncePrice);

        return $saleDataArray;
    }
}

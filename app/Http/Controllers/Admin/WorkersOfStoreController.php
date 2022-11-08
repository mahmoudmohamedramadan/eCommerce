<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;
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
        $stores = Store::get();
        $workers = array();

        foreach ($store->workers as $worker) {
            array_push($workers, $worker);
        }

        return view('admin.store_workers.index', compact('workers', 'stores'))->with('store_id', $store->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Store  $store
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Store $store, Worker $worker)
    {
        try {
            DB::beginTransaction();
            $worker->update([
                'store_id' => request()->get('store_id')
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('stores.workers.index', $store->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('success', __('translate.updated_error'));
            return redirect()->route('stores.workers.index', $store->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Worker $worker)
    {
        try {
            DB::beginTransaction();
            $worker->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('stores.workers.index', $store->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('stores.workers.index', $store->id);;
        }
    }
}

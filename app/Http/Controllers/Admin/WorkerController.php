<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;
use App\Models\Store;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::all();

        return view('admin.worker.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::get();

        return view('admin.worker.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        try {
            DB::beginTransaction();
            $photoName = savePhoto('photo', $request->photo, 'assets/images/worker');

            Worker::create([
                'name' => $request->name,
                'age' => $request->age,
                'national_id' => $request->national_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'salary' => $request->salary,
                'per' => $request->per,
                'store_id' => $request->store_id,
                'worker_permission' => $request->worker_permission,
                'photo' => $photoName
            ]);
            DB::commit();

            session()->flash('success', __('translate.saved_success'));
            return redirect()->route('workers.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.saved_error'));
            return redirect()->route('workers.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        $stores = Store::get();

        return view('admin.worker.edit', compact('worker', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(WorkerRequest $request, Worker $worker)
    {
        try {
            DB::beginTransaction();
            if (deletePhoto('photo', $worker, 'assets/images/worker/') or $request->photo) {
                //save photo after delete old one
                $photoName = savePhoto('photo', $request->photo, 'assets/images/worker');
                //update photo name in DB
                $worker->update([
                    'photo' => $photoName
                ]);
            }

            $worker->update([
                'name' => $request->name,
                'age' => $request->age,
                'national_id' => $request->national_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'per' => $request->per,
                'store_id' => $request->store_id,
                'worker_permission' => $request->worker_permission,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('workers.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.updated_error'));
            return redirect()->route('workers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        try {
            DB::beginTransaction();
            deletePhoto('photo', $worker, 'assets/images/worker/');
            $worker->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('workers.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('workers.index');;
        }
    }
}

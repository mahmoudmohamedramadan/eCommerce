<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Admin, Debt};
use App\Http\Controllers\Controller;
use App\Http\Requests\DebtRequest;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debts = Debt::all();

        return view('admin.debts.index', compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.debts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DebtRequest $request)
    {
        try {
            DB::beginTransaction();
            Debt::create([
                'title' => $request->title,
                'details' => $request->details,
                'pay_date' => $request->pay_date,
                'remember_date' => $request->remember_date,
            ]);
            DB::commit();

            session()->flash('success', __('translate.saved_success'));
            return redirect()->route('debts.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.saved_error'));
            return redirect()->route('debts.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @param  string  $notification_id
     * @return \Illuminate\Http\Response
     */
    public function show(Debt $debt, $notification_id)
    {
        Admin::first()->notifications->find($notification_id)->markAsRead();

        return view('admin.debts.edit', compact('debt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        return view('admin.debts.edit', compact('debt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(DebtRequest $request, Debt $debt)
    {
        try {
            DB::beginTransaction();
            $debt->update([
                'title' => $request->title,
                'details' => $request->details,
                'pay_date' => $request->pay_date,
                'remember_date' => $request->remember_date,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('debts.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.updated_error'));
            return redirect()->route('debts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        try {
            DB::beginTransaction();
            $debt->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('debts.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('debts.index');
        }
    }
}

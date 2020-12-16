<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DebtRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Debt;
use App\Notifications\DebtNotification;

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

    /**
     *
     * Push notification into database
     * @return void
     */
    public function pushNotifications()
    {
        $rememberDebts = Debt::notification()->get();

        if (isset($rememberDebts)) {
            foreach ($rememberDebts as $rememberDebt) {
                $notificatedDebt = DB::table('notifications')->select('*')
                    ->where('data', '{"id":' . $rememberDebt->id . ',"title":"' . $rememberDebt->title . '","details":"' . $rememberDebt->details . '","pay_date":"' . $rememberDebt->pay_date . '"}')
                    ->whereNotNull('read_at')
                    ->get();

                if (empty($notificatedDebt)) {
                    Admin::first()->notify(new DebtNotification($rememberDebt));
                }
            }

            $noificationView = view('admin.includes.notifications', ['notifications' => $rememberDebts])
                ->render();

            return response()->json([
                'success' => true,
                'notifications_count' => count($rememberDebts),
                'notifications' => $noificationView
            ]);
        }

        return response()->json([
            'success' => true,
            'notifications_count' => 0,
            'notifications' => null
        ]);
    }
}

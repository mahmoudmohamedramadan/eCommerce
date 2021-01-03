<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ProductNotification;
use App\Notifications\DebtNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Debt;

class AdminController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            DB::beginTransaction();
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('admin.edit', $admin->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('success', __('translate.updated_error'));
            return redirect()->route('admin.edit', $admin->id);
        }
    }

    /**
     *
     * Push notification into database
     * @return \Illuminate\Http\Response
     */
    public function pushNotifications()
    {
        if (Product::unnotifiedProducts()->get()->count() > 0) {
            $UnNotifiedProducts = Product::unnotifiedProducts()->get();

            foreach ($UnNotifiedProducts as $product) {
                if ($product->used_quantity <= $product->minimum_used or $product->stored_quantity <= $product->minimum_stored) {
                    Admin::first()->notify(new ProductNotification(($product)));

                    $product->update([
                        'notified' => true
                    ]);
                }
            }
        }

        $UnNotifiedDebts = Debt::unnotifiedDebts()->get();

        if (isset($UnNotifiedDebts)) {
            foreach ($UnNotifiedDebts as $debt) {
                Admin::first()->notify(new DebtNotification($debt));

                $debt->update([
                    'notified' => true
                ]);
            }
        }

        $notifications = Admin::first()->notifications;
        $unReadNotifications = Admin::first()->unReadNotifications;

        if (isset($notifications)) {
            $noificationView = view('admin.includes.notifications', ['notifications' => $notifications])
                ->render();

            return response()->json([
                'success' => true,
                'notifications_count' => count($unReadNotifications),
                'notifications' => $noificationView
            ]);
        }

        return response()->json([
            'success' => true,
            'notifications_count' => 0,
            'notifications' => null
        ]);
    }

    /**
     *
     * Read all debt notifications
     */
    public function readAllNotifications()
    {
        if (Admin::first()->unreadNotifications->count() > 0) {
            Admin::first()->unreadNotifications->each(function ($notification) {
                $notification->markAsRead();
            });

            return response()->json([
                'success' => true,
                'notifications_count' => 0,
                'notifications' => null
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}

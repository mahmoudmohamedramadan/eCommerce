<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

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
}

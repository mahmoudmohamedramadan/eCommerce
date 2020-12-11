<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.company.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        try {
            //dd($request->input());
            DB::beginTransaction();
            Company::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'manager' => $request->manager,
            ]);
            DB::commit();

            session()->flash('success', __('translate.saved_success'));
            return redirect()->route('companies.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.saved_error'));
            return redirect()->route('companies.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            DB::beginTransaction();
            $company->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'manager' => $request->manager,
            ]);
            DB::commit();

            session()->flash('success', __('translate.updated_success'));
            return redirect()->route('companies.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.updated_error'));
            return redirect()->route('companies.index');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            DB::beginTransaction();
            $company->delete();
            DB::commit();

            session()->flash('success', __('translate.deleted_success'));
            return redirect()->route('companies.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', __('translate.deleted_error'));
            return redirect()->route('companies.index');;
        }
    }
}

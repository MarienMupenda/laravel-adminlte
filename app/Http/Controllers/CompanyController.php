<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Company $company)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $data = [
            'company' => $company,
            'title' => $company->name,
            'businesses' => Business::orderBy('name')->get(),
            'currencies' => Currency::orderBy('name')->get(),
        ];

        return view('dashboard.companies.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'business_id' => ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'],
            'rccm' => ['nullable', 'string'],
            'idnat' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('logo')) {
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = time() . '.' . $extension;

            $request->file('logo')->storeAs('public/companies/' . $company->id, $fileNameToStore);

        } else {
            $fileNameToStore = "";
        }


        if ($request->hasFile('logo')) {
            $company->delete_logo();
            $data['logo'] = $fileNameToStore;
        }


        $company->update($data);

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

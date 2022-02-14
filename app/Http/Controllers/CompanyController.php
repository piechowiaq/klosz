<?php

namespace App\Http\Controllers;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Requests\StoreCompanyRequest;
use App\Domains\Company\Requests\UpdateCompanyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Companies/Index', [
            'companies' => Company::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $company = new Company();
        $company->name = ($request->get('name'));
        $company->city = ($request->get('city'));
        $company->email = ($request->get('email'));
        $company->phone = ($request->get('phone'));
        $company->save();

        return Redirect::route('companies.edit',  ['company' => $company])->with('success', 'Company created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company): Response
    {
        return Inertia::render('Companies/Edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update( UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $company->name = ($request->get('name'));
        $company->city = ($request->get('city'));
        $company->email = ($request->get('email'));
        $company->phone = ($request->get('phone'));
        $company->save();

        return Redirect::route('companies.index')->with('success', 'Company updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return Redirect::route('companies.index')->with('success', 'Company deleted.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use App\Domains\Company\Requests\StoreCompanyRequest;
use App\Domains\Company\Requests\UpdateCompanyRequest;
use App\Domains\Company\Services\CompanyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Companies/Index', [
            'filters' => $request->all(['search', 'trashed']),
            'companies' => Company::when($request->input('search'), function ($query, $search) {

                $query->where('name' , 'like', '%' . $search. '%')
                    ->orWhere('city', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            })
                ->when($request->input('trashed'), function ($query, $trashed) {
                    if ($trashed === 'with') {
                        $query->withTrashed();
                    } elseif ($trashed === 'only') {
                        $query->onlyTrashed();
                    }
                })->paginate(10)
                ->withQueryString()
                ->through(fn($company) => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'city' => $company->last_name,
                    'email' => $company->email,
                    'phone' => $company->phone,
                    'deleted_at' => $company->deleted_at
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Companies/Create',[
        'registries' => Registry::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $company = $this->companyService->create($request->get('name'),
            $request->get('city'),
            $request->get('email'),
            $request->get('phone'));

        $registries = Registry::all();
        $companyRegistries = Registry::findMany($request->get('registry_ids'));

        $company->registries()->syncWithPivotValues($registries, ['assigned' => false]);
        $company->registries()->detach($companyRegistries);
        $company->registries()->attach($companyRegistries, ['assigned' => true]);

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
        return Inertia::render('Admin/Companies/Show', [
            'company' => $company,
            'registries' => Registry::all()->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company): Response
    {
        $registries = $company->registries()->where('assigned', 1)->get();

        $companyRegistries = $registries->map(function ($registry, $key) {
        return $registry->id;
    });
        return Inertia::render('Admin/Companies/Edit', [
            'company' => $company,
            'registries' => $company->registries()->get(),
            'registry_ids' => $companyRegistries->toArray(),
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
        $this->companyService->update($company, $request->get('name'),
            $request->get('city'),
            $request->get('email'),
            $request->get('phone'));

        $companyRegistries = Registry::findMany($request->get('registry_ids'));

        $registries = Registry::all();
        $company->registries()->syncWithPivotValues($registries, ['assigned' => false]);
        $company->registries()->detach($companyRegistries);
        $company->registries()->attach($companyRegistries, ['assigned' => true]);

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

    public function restore(Company $company): RedirectResponse
    {
        $company->restore();

        return Redirect::route('companies.index')->with('success', 'Company restored.');
    }
}

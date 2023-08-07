<?php

namespace App\Http\Controllers\User;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use App\Domains\Company\Models\Report;
use App\Domains\Company\Requests\StoreRegistryRequest;
use App\Domains\Company\Requests\UpdateRegistryRequest;
use App\Domains\Company\Services\RegistryService;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use voku\helper\ASCII;

class RegistryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, Company $company): Response
    {
        $query = DB::table('registries')
            ->join('company_registry', 'registries.id', '=', 'company_registry.registry_id')
            ->leftJoin('reports', function ($join) {
                $join->on('company_registry.registry_id', '=', 'reports.registry_id')
                    ->on('company_registry.company_id', '=', 'reports.company_id')
                    ->whereRaw('reports.expiry_date = (SELECT MAX(expiry_date) FROM reports WHERE reports.registry_id = company_registry.registry_id)');
            })
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->select('company_registry.registry_id', 'registries.name', DB::raw('MAX(reports.expiry_date) as expiry_date'), 'company_registry.company_id')
            ->groupBy('company_registry.registry_id', 'registries.name', 'company_registry.company_id');




        if ($request->has('search')){
            $query->where('registries.name', 'like', '%' .$request->get('search') . '%');
        }

        if($request->has(['field', 'direction'])){

            $query->orderBy($request->get('field'), $request->get('direction'));
        }

        $companies = Auth::user()->companies()->pluck('company_id');



        return Inertia::render('User/Pages/Registries/Index', [
            'registries' => $query->paginate(10)
                ->withQueryString(),
            'filters'=> $request->all(['search', 'field', 'direction']),
            'company' => $company,
            'companies' => $companies,
            'countOfUpToDateRegistries' => $query->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->get()->count()
            ]);
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRegistryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRegistryRequest $request): RedirectResponse
    {
//        $registry = $this->registryService->create($request->get('name'), $request->get('description'), $request->get('valid_for'));
//
//        $registry->companies()->sync(Company::all());
//        return Redirect::route('registries.edit', ['registry' => $registry])->with('success', 'Registry created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param Registry $registry
     * @return Response
     */
    public function show(Company $company, Registry $registry)
    {
        $companies = Auth::user()->companies()->pluck('company_id');

        return Inertia::render('User/Pages/Registries/Show', [
            'company' => $company,
            'registry' => $registry,
            'reports' => $registry->reports()->where('company_id', $company->id)->get()->toArray(),
            'companies' => $companies,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Registry $registry
     * @return Response
     */
    public function edit(Registry $registry): Response
    {
//        return Inertia::render('Registries/Edit', [
//            'registry' => $registry,
//        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRegistryRequest $request
     * @param Registry $registry
     * @return RedirectResponse
     */
    public function update(UpdateRegistryRequest $request, Registry $registry): RedirectResponse
    {
//        $this->registryService->update($registry, $request->get('name'), $request->get('description'), $request->get('valid_for'));
//        $registry->companies()->sync(Company::all());
//        return Redirect::route('registries.index')->with('success', 'Registry updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Registry $registry
     * @return RedirectResponse
     */
    public function destroy(Registry $registry): RedirectResponse
    {
//        $registry->delete();
//
//        return Redirect::route('registries.index')->with('success', 'Registry deleted.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Registry $registry
     * @return RedirectResponse
     */
    public function restore(Registry $registry): RedirectResponse
    {
//        $registry->restore();
//
//        return Redirect::route('registries.index')->with('success', 'Registry restored.');
    }
}

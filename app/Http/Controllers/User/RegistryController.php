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
        $query = $company->registries()
                ->where(['assigned' => true])
                ->with('reports', function($query) use ($company){
                    return $query->where('company_id', '=', $company->id)->max('expiry_date');
                });

        if ($request->has('search')){
            $query->where('name', 'like', '%' .$request->get('search') . '%');
        }

        if($request->has(['field', 'direction'])){

            $query->orderBy($request->get('field'), $request->get('direction'));
        }

        return Inertia::render('User/Pages/Registries/Index', [
            'registries' => $query->paginate(10)
                ->withQueryString()->through(fn($registry) => [
                    'id' => $registry->id,
                    'name' => $registry->name,
                    'latest_date' => $registry->reports()->where('company_id', $company->id)->max('expiry_date'),
                    'expiry_days' =>  Carbon::now()->diffInDays(Carbon::parse($registry->reports()->where('company_id', $company->id)->max('expiry_date')), false)
                ]),
            'filters'=> $request->all(['search', 'field', 'direction']),
            'company' => $company,
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
     * @param int $id
     * @return Response
     */
    public function show(Company $company, Registry $registry)
    {
        return Inertia::render('User/Pages/Registries/Show', [
            'company' => $company,
            'registry' => $registry,
            'reports' => $registry->reports()->where('company_id', $company->id)->get()->toArray()
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

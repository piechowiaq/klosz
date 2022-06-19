<?php

namespace App\Http\Controllers\User;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use App\Domains\Company\Requests\StoreRegistryRequest;
use App\Domains\Company\Requests\UpdateRegistryRequest;
use App\Domains\Company\Services\RegistryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RegistryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, Company $company): Response
    {


        $registries = $company->registries()->where(['assigned' => true])->get();
        return Inertia::render('User/Pages/Registries/Index', [
            'filters' => $request->all(['search', 'trashed']),
            'registries' => $registries,
            'company' => $company
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

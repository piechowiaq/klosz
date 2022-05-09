<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\User\Requests\StorePermissionRequest;
use App\Domains\User\Requests\UpdatePermissionRequest;
use App\Domains\User\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use App\Domains\User\Models\Permission;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    /**
     * @var PermissionService
     */
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Permissions/Index', [
            'filters' => $request->all(['search', 'trashed']),
            'permissions' => Permission::when($request->input('search'), function ($query, $search) {

                $query->where('name' , 'like', '%' . $search. '%');

            })
                ->when($request->input('trashed'), function ($query, $trashed) {
                    if ($trashed === 'with') {
                        $query->withTrashed();
                    } elseif ($trashed === 'only') {
                        $query->onlyTrashed();
                    }
                })->paginate(10)
                ->withQueryString()
                ->through(fn($permission) => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'deleted_at' => $permission->deleted_at
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
        return Inertia::render('Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $permission = $this->permissionService->create($request->get('name'));

        return Redirect::route('permissions.edit',  ['permission' => $permission])->with('success', 'Permission created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return Response
     */
    public function show(Permission $permission): Response
    {
        return Inertia::render('Permissions/Show', [
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission): Response
    {
        return Inertia::render('Permissions/Edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update( UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $this->permissionService->update($permission, $request->get('name'));

        return Redirect::route('permissions.index')->with('success', 'Permission updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return Redirect::route('permissions.index')->with('success', 'Permission deleted.');
    }
    public function restore(Permission $permission): RedirectResponse
    {
        $permission->restore();

        return Redirect::route('permissions.index')->with('success', 'Permission restored.');
    }
}

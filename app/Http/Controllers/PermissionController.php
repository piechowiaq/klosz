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
use Spatie\Permission\Models\Permission;
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
    public function index(): Response
    {
        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::paginate(10)
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
}

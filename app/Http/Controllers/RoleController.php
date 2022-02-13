<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\User\Requests\StoreRoleRequest;
use App\Domains\User\Requests\UpdateRoleRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @property Permission[]|Collection
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Roles/Create', [
            'permissions' => Permission::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = new Role();
        $role->name = $request->get('name');
        $role->save();

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.edit', ['role' => $role]);
    }


    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return Inertia::render('Roles/Show', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role): Response
    {
        $permissions = Permission::all()->toArray();

        $rolePermissionIds = $role->getAllPermissions()->pluck('id')->toArray();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'permission_ids' => $rolePermissionIds
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->name = $request->get('name');

        $role->save();

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return Redirect::route('roles.index');
    }
}

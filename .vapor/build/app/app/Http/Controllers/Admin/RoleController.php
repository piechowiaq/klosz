<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domains\User\Models\Permission;
use App\Domains\User\Models\Role;
use App\Domains\User\Requests\StoreRoleRequest;
use App\Domains\User\Requests\UpdateRoleRequest;
use App\Domains\User\Services\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @property Permission[]|Collection
 */
class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Roles/Index', [
            'filters' => $request->all(['search', 'trashed']),
            'roles' => Role::when($request->input('search'), function ($query, $search) {

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
                ->through(fn($role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'deleted_at' => $role->deleted_at
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
        return Inertia::render('Admin/Roles/Create', [
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
        $role = $this->roleService->create($request->get('name'));

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.edit', ['role' => $role])->with('success', 'Role created.');
    }


    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return Inertia::render('Admin/Roles/Show', [
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

        return Inertia::render('Admin/Roles/Edit', [
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
        $this->roleService->update($role, $request->get('name'));

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.index')->with('success', 'Role updated.');
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

        return Redirect::route('roles.index')->with('success', 'Role deleted.');
    }

    public function restore(Role $role): RedirectResponse
    {
        $role->restore();

        return Redirect::route('roles.index')->with('success', 'Role restored.');
    }
}

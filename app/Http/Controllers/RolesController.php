<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\User\Requests\StoreRoleRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @property Permission[]|Collection
 */
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::all()
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
            'permissions' => Permission::all()
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
        /**
         * @var Role $role
         */
        $role = Role::create(['name' => $request->get('name')]);

        $permissionIds = $request->get('permissionIds');

        $permissions = new Collection();

        if(is_array($permissionIds)){
            foreach ($permissionIds as $permission=>$permissionId){
                if ($permissionId == 'on'){
                    $permissions->add($permission);
                }
            }
        }

        $role->syncPermissions($permissions);

        return Redirect::route('roles.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function destroy($request): RedirectResponse
    {
        Role::findById((int)$request)->delete();

        return Redirect::route('roles.index');
    }
}

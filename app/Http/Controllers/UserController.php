<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Domains\User\Models\User;
use App\Domains\User\Requests\StoreUserRequest;
use App\Domains\User\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => User::paginate(10)->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->password = Hash::make($request['password']);
        $user->email = $request->get('email');
        $user->save();

        $user->assignRole($request->get('role_id'));

        return Redirect::route('users.show', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
       return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => Role::all()->toArray(),
            'role_id' => $user->roles()->first()->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request['password']);
        $user->save();

        $user->syncRoles($request->get('role_id'));

        return Redirect::route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return Redirect::route('users.index');
    }
}

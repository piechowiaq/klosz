<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Domains\Company\Models\Company;
use App\Domains\User\Models\User;
use App\Domains\User\Requests\StoreUserRequest;
use App\Domains\User\Requests\UpdateUserRequest;
use App\Domains\User\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    use HasRoles;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws Exception
     */
    public function create(): Response
    {
//        /** @var User $user */
//        $user = Auth::user();
//
//        if ($user->cannot('manage users')){
//            throw new Exception('Cant manage users');
//        }
        return Inertia::render('Users/Create', [
            'roles' => Role::all()->toArray(),
            'companies' => Company::all()->toArray()
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
        $user = $this->userService->create($request->get('name'), $request->get('last_name'), $request->get('password'), $request->get('email'), $request->get('phone'), $request->get('role_id'));

        $companyIds = $request->get('company_ids');
        $companies  = new Collection();

        if (is_array($companyIds)) {
            $companies = Company::whereIn('id', $companyIds)->get();
        }

        $user->companies()->sync($companies);

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
           'companies' => Company::all()->toArray(),
           'company_ids' => $user->companies()->get()->pluck('id')->toArray()
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
        $this->userService->update($user, $request->get('name'), $request->get('last_name'), $request->get('password'), $request->get('email'), $request->get('phone'), $request->get('role_id'));

        $companyIds = $request->get('company_ids');
        $companies  = new Collection();

        if (is_array($companyIds)) {
            $companies = Company::whereIn('id', $companyIds)->get();
        }

        $user->companies()->sync($companies);

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

<?php

namespace App\Http\Controllers\User;

use App\Domains\Company\Models\Company;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function navigate(User $user): Response
    {
        $userCompanies = $user->companies()->get();

        return Inertia::render('User/Navigate', ['userCompanies' => $userCompanies]);
    }
    public function dashboard(Company $company): Response
    {
        return Inertia::render('User/Dashboard', ['company' => $company]);
    }
}

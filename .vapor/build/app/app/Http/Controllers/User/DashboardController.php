<?php

namespace App\Http\Controllers\User;

use App\Domains\Company\Models\Company;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $query = DB::table('registries')
            ->join('company_registry', 'registries.id' ,'=', 'company_registry.registry_id')
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->leftjoin('reports', function($join){
                $join->on('company_registry.registry_id', '=', 'reports.registry_id')
                    ->on('company_registry.company_id', '=', 'reports.company_id');
            })
            ->select('company_registry.registry_id','registries.name', DB::raw('MAX(expiry_date) as expiry_date'),'company_registry.company_id' )
            ->groupBy('company_registry.registry_id');

       $companies = Auth::user()->companies()->pluck('company_id');



        return Inertia::render('User/Dashboard', [
            'company' => $company,
            'companies' => $companies,
            'registries' => $query->paginate(10)
            ->withQueryString(),
            'countOfUpToDateRegistries' => $query->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->get()->count()
        ]);
    }
}

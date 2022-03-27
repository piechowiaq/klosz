<?php

declare(strict_types=1);

namespace App\Domains\Company\Services;

use App\Domains\Company\Models\Company;
use Illuminate\Support\Facades\Gate;

class CompanyService
{
    /**
     * @param string $name
     * @param string $city
     * @param string $email
     * @param string $phone
     * @return Company
     */
    public function create(string $name, string $city, string $email, string $phone): Company
    {
        $company = new Company();
        $company->name = $name;
        $company->city = $city;
        $company->email = $email;
        $company->phone = $phone;
        $company->save();

        return $company;
    }

    /**
     * @param Company $company
     * @param string $name
     * @param string $city
     * @param string $email
     * @param string $phone
     * @return Company
     */
    public function update(Company $company, string $name, string $city, string $email, string $phone): Company
    {
        if(! Gate::allows('update-company', $company)){
            abort(403);
        }
        $company->name = $name;
        $company->city = $city;
        $company->email = $email;
        $company->phone = $phone;
        $company->save();

        return $company;
    }
}

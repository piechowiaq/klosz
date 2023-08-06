<?php

namespace Database\Seeders;

use App\Domains\Company\Services\CompanyService;
use App\Domains\User\Services\UserService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    private $companyService;
    private $userService;

    /**
     * @var CompanyService
     * @var UserService
     */
    public function __construct(CompanyService $companyService, UserService $userService)
    {
        $this->companyService = $companyService;
        $this->userService = $userService;
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->companyService->create('Hotel',
            'Warszawa',
            'hotel@email.com',
            '08753153');

        $this->userService->create('John',
            'Doe',
            '12345678',
            'john.doe@email.com',
            '+48',
            Role::create(['name' => 'Super Admin'])->id);


        $this->call([RegistrySeeder::class
        ]);
    }
}

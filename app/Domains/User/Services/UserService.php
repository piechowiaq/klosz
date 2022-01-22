<?php

declare(strict_types=1);


namespace App\Domains\User\Services;


use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{


    public function create(string $name, string $password, string $email, int $roleId): User
    {

        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->save();

        $user->assignRole($roleId);

        return $user;
    }


    public function update(User $user, string $name, string $password, string $email, int $roleId): User
    {
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->save();

        $user->syncRoles($roleId);

        return $user;
    }
}

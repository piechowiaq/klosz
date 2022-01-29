<?php

declare(strict_types=1);


namespace App\Domains\User\Services;


use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{


    public function create(string $name, string $lastName, string $password, string $email, string $phone, int $roleId): User
    {

        $user = new User();
        $user->name = $name;
        $user->last_name = $lastName;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->phone = $phone;
        $user->save();

        $user->assignRole($roleId);

        return $user;
    }


    public function update(User $user, string $name, string $lastName, $password, string $email, string $phone, int $roleId): User
    {

        $user->name = $name;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->phone = $phone;
        $user->save();

        if ($password) {
            $user->password = Hash::make((string)$password);
            $user->save();
        }

        $user->syncRoles($roleId);

        return $user;
    }
}

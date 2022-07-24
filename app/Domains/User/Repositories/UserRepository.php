<?php

declare(strict_types=1);


namespace App\Domains\User\Repositories;



use App\Domains\User\Models\User;

class UserRepository
{
public function getById(int $id){

    return User::query()->find($id);

}
}


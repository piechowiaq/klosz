<?php

declare(strict_types=1);


namespace App\Domains\User\Repositories;



use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
public function getById(int $id): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
{

    return User::query()->find($id);

}
}


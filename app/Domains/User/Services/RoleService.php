<?php

declare(strict_types=1);

namespace App\Domains\User\Services;

use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * @param string $name
     * @return Role
     */
    public function create(string $name): Role
    {
        $role = new Role();
        $role->name = $name;
        $role->save();

        return $role;
    }

    /**
     * @param Role $role
     * @param string $name
     * @return Role
     */
    public function update(Role $role, string $name): Role
    {
        $role->name = $name;
        $role->save();

        return $role;
    }
}


<?php

declare(strict_types=1);

namespace App\Domains\User\Services;


use Spatie\Permission\Models\Permission;

class PermissionService
{
    /**
     * @param string $name
     * @return Permission
     */
    public function create(string $name): Permission
    {
        $permission = new Permission();
        $permission->name = $name;
        $permission->save();

        return $permission;
    }

    /**
     * @param Permission $permission
     * @param string $name
     * @return Permission
     */
    public function update(Permission $permission, string $name): Permission
    {
        $permission->name = $name;
        $permission->save();

        return $permission;
    }
}


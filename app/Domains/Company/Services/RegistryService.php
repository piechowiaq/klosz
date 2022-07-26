<?php

declare(strict_types=1);

namespace App\Domains\Company\Services;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegistryService
{
    /**
     * @param string $name
     * @param string $description
     * @param string $valid_for
     * @return Registry
     */
    public function create(string $name, string $description, string $valid_for): Registry
    {
        $registry = new Registry();
        $registry->name = $name;
        $registry->description = $description;
        $registry->valid_for = $valid_for;
        $registry->save();

        return $registry;
    }

    /**
     * @param Registry $registry
     * @param string $name
     * @param string $description
     * @param string $valid_for
     * @return Registry
     */
    public function update(Registry $registry, string $name, string $description, string $valid_for): Registry
    {
        $registry->name = $name;
        $registry->description = $description;
        $registry->valid_for = $valid_for;
        $registry->save();

        return $registry;
    }
}

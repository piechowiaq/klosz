<?php

namespace App\Domains\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Vendor\Spatie\Laravel-permission\Src\Models\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $valid_for
 *
 */

class Registry extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ResolveRouteBinding;

    /** @var array|string[] */
    protected $guarded = [];

    public function companies(): Relation
    {
        return $this->belongsToMany(Company::class);
    }




}

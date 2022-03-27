<?php

namespace App\Domains\Company\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * App\Vendor\Spatie\Laravel-permission\Src\Models\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $city
 * @property string $email
 * @property string $phone
 *
 */

class Company extends Model
{
    use HasFactory;

    /** @var array|string[] */
    protected $guarded = [];

    public function users(): Relation
    {
        return $this->belongsToMany(User::class);
    }

    public function getByUserId(User $user){
        return $this->users()->get()->find($user)->id;

    }
}

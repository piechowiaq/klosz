<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    private const NAME_COLUMN        = 'name';
    private const GUARD_NAME_COLUMN        = 'guard_name';

    protected $guarded = [];
    /**
     * @var mixed
     */

}

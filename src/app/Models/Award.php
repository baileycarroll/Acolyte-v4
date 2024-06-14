<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Award extends Model
{
    public function users() :HasManyThrough {
        return $this->hasManyThrough(User_Award::class, User::class);
    }
}

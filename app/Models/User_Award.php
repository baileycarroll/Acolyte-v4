<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User_Award extends Model
{
    protected $table = 'user_awards';
    public function users() :HasMany {
        return $this->hasMany(User::class);
    }
    public function awards() :HasMany {
        return $this->hasMany(Award::class);
    }
}

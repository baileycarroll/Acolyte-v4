<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discussions extends Model
{
    public function module() :HasOne {
        return $this->hasOne(Module::class);

    }
    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }
}

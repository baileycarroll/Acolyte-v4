<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function courses() :HasMany {
        return $this->hasMany(Course::class);
    }
    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }
}

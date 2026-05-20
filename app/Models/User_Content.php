<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User_Content extends Model
{
    protected $table = 'user_content';

    public function users() :HasMany{
        return $this->hasMany(User::class);
    }
    public function courses() :BelongsToMany {
        return $this->belongsToMany(Course::class);
    }
    public function classes() :BelongsToMany {
        return $this->belongsToMany(Classes::class);
    }
}

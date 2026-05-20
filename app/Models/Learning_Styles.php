<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Learning_Styles extends Model
{
    protected $table = 'learning_styles';
    public function users() :BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }
    public function courses() :HasMany {
        return $this->hasMany(Course::class);
    }
}

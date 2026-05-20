<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content_Types extends Model
{
    protected $table = 'content_types';
    public function classes() :HasMany {
       return $this->hasMany(Classes::class);
    }
    public function courses() :HasMany {
        return $this->hasMany(Course::class);
    }
}

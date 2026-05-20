<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name'];
    public function users() :HasMany {
        return $this->hasMany(User::class);
    }
    public function announcements() :HasMany {
        return $this->hasMany(Announcement::class);
    }
    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }
    public function courses() :HasMany {
        return $this->hasMany(Course::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Gradebook extends Model
{
    protected $table = 'gradebook';
    public function users() :BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    public function classes() :BelongsToMany {
        return $this->belongsToMany(Classes::class);
    }
    public function courses() :BelongsToMany {
        return $this->belongsToMany(Course::class);
    }
    public function module() :BelongsToMany {
        return $this->belongsToMany(Module::class);
    }
}

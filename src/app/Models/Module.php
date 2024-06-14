<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public function gradebook() {
        return $this->hasMany(Gradebook::class);
    }
    public function courses() {
        return $this-> belongsTo(Course::class);
    }
}

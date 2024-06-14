<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discussions extends Model
{
    use HasFactory;
    public function module() {
        return $this->hasOne(Module::class);

    }
    public function classes() {
        return $this->hasMany(Classes::class);
    }
}

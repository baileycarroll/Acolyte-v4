<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content_Type extends Model
{
    use HasFactory;
    protected $table="content_types";

    public function classes() {
        $this->hasMany(Classes::class);
    }
    public function courses() {
        $this->hasMany(Course::class);
    }
}

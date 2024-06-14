<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function courses() {
        return $this->belongsToMany(Course::class);
    }
    public function classes() {
        return $this->belongsToMany(Classes::class);
    }
    public static function getCategories() {
        return Category::query()->select('id', 'name', 'updated_at')->paginate(10);
    }
}

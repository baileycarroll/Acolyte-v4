<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalog extends Model
{
 protected $with = ['courses', 'classes'];

    public function scopeFilter($query, array $filters) {
        if($filters['category'] ?? false) {
            $query->where("status", '=', 'Active')->where('category_1', '=', request('category'))->orWhere('category_2', '=', request('category'))->orWhere('category_3', '=', request('category'));
        }
        if($filters['search'] ?? false) {
            $query->where("status", '=', 'Active')->where('name', 'like', '%' . request('search') . '%')->orWhere('excerpt', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }
    public function courses() :HasMany {
        return $this->hasMany(Course::class);
    }
    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }
}

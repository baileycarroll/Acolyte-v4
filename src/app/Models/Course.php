<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    public function scopeFilter($query, array $filters) {
        $query->when($filters['category'] ?? false, function($query, $category) {
            $query->where("status", '=', 'Active')
                ->where('category_1', '=', $category)
                ->orWhere('category_2', '=', $category)
                ->orWhere('category_3', '=', $category);
        });
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->where("status", '=', 'Active')
                ->orWhere('excerpt', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }
    public function department() :BelongsTo {
        return $this->belongsTo(Department::class);
    }
    public function users() :HasManyThrough{
        return $this->hasManyThrough(User_Content::class, User::class);
    }
    public function learning_style() :HasOne {
        return $this->hasOne(Learning_Styles::class);
    }
    public function categories() :BelongsToMany {
        return $this->belongsToMany( Category::class);
    }
    public function gradebook() :HasMany {
        return $this->hasMany(Gradebook::class);
    }
    public function content_type() :BelongsTo {
        return $this->belongsTo(Content_Types::class);
    }
}

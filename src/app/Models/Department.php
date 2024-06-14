<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Defining the relationship with other objects. Options are:
    // hasOne, hasMany, belongsTo, belongsToMany
    public function announcement() {
        return $this->hasMany(Announcement::class);
    }
    public function classes() {
        return $this->hasMany(Classes::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
    public function courses() {
        return $this->hasMany(Course::class);
    }
    public static function getDepartments() {
        return Department::query()->select('id', 'name', 'updated_at')->paginate(10);
    }
    public static function getCountDepts() {
        $numDepts = Department::all()->count();
        return $numDepts;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User_Content extends Model
{
    use HasFactory;
    protected $table = 'user_content';

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function course() {
        return $this->belongsToMany(Course::class);
    }
    public function classes() {
        return $this->belongsToMany(Classes::class);
    }
}

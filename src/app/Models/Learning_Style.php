<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learning_Style extends Model
{
    use HasFactory;
    public $table = 'learning_styles';
    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function classes() {
        return $this->belongsToMany(Classes::class);
    }
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
    public static function getLearningStyles() {
        $learning_styles = Learning_Style::all();
        return $learning_styles;
    }
    public static function getLearningStylesAdmin() {
        return Learning_Style::query()->select('*')->paginate(10);
    }
}

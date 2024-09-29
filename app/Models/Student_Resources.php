<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student_Resources extends Model
{
    protected $table = 'student_resources';
    protected $with = ['resource_type'];
    protected $fillable = ['name', 'description', 'url', 'type'];

    public function resource_type() :BelongsTo {
        return $this->belongsTo('App\Models\Resource_Types', 'type');
    }
}

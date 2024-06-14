<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource_Types extends Model
{
    use HasFactory;
    protected $table = 'resource_types';

    public static function getResourceTypes() {
        return Resource_Types::query()->select('*')->paginate(10);
    }

    public function student_resources() {
        return $this->hasOne(Resource_Types::class);
    }
}


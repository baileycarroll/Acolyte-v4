<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Resources extends Model
{
    use HasFactory;

    protected $table = 'student_resources';

    public static function getResources() {
        return array_values(Student_Resources::query()
            ->leftJoin('resource_types', 'student_resources.type', '=', 'resource_types.id')
            ->select('student_resources.id', 'student_resources.name', 'student_resources.description', 'student_resources.type', 'resource_types.name AS resource_type_name'
                , 'student_resources.url', 'student_resources.updated_at')->get()->toArray());
    }

    public function resource() {
        return $this->belongsTo(Resource_Types::class);
    }
}

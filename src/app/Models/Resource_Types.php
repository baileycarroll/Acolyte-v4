<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource_Types extends Model
{
    protected $table = 'resource_types';

    public function resources() :HasMany {
        return $this->hasMany(Student_Resources::class);
    }
}


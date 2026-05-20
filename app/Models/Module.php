<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    public function grades() :HasMany {
        return $this->hasMany(Gradebook::class);
    }
    public function course() :BelongsTo{
        return $this-> belongsTo(Course::class);
    }
    public function quiz() :HasOne {
        return $this->hasOne(Quiz::class);
    }
}

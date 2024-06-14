<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    public function class() :BelongsTo {
        return $this->belongsTo(Classes::class);
    }
    public function module() :BelongsTo {
        return $this->belongsTo(Module::class);
    }
}

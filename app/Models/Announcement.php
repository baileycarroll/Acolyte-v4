<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{

    protected $fillable = [
        'content',
        'department',
        'department_only',
        'expiration',
    ];

    public function department() :BelongsTo {
        return $this->belongsTo(Announcement::class);
    }
}

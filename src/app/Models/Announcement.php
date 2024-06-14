<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'department',
        'department_only',
        'expiration',
    ];

    public function department() {
        return $this->belongsTo(Announcement::class);
    }
}

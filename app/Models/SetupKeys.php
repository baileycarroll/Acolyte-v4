<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetupKeys extends Model
{
    protected $table = 'setup_keys';
    protected $fillable = ['key', 'value'];
}

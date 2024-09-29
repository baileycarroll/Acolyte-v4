<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Licenses extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stripe_api_id', 'trial', 'admin'];

    public function users() :HasMany {
        return $this->hasMany(User::class);
    }
}

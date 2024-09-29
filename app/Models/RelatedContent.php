<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RelatedContent extends Model
{
    use HasFactory;

    public function classes() :HasMany {
        return $this->hasMany(Classes::class);
    }

    public function modules() :HasMany {
        return $this->hasMany(Modules::class);
    }
}

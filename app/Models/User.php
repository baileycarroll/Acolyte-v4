<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' =>'date',
    ];
    public function departments() :BelongsToMany {
        return $this->belongsToMany(Department::class);
    }
    public function classes() :HasManyThrough {
        return $this->hasManyThrough(User_Content::class, Classes::class);
    }
    public function courses() :HasManyThrough {
        return $this->hasManyThrough(User_Content::class, Course::class);
    }
    public function learning_style() :HasOne {
        return $this->hasOne(Learning_Styles::class);
    }
    public function awards() :HasManyThrough {
        return $this->hasManyThrough(User_Award::class, Award::class);
    }
    public function grades() :HasMany {
        return $this->hasMany(Gradebook::class);
    }
    public function license() :BelongsTo {
        return $this->belongsTo(Licenses::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    use HasFactory;

    protected $guarded = ['admin'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
    public static function getLicenses() {
        $licenses = Licenses::query()->select('*')->paginate(10);
        return $licenses;
    }
}

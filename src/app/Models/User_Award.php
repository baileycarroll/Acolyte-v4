<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_Award extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsTo(User::class);
    }
    public function award() {
        return $this->belongsTo(Award::class);
    }
    public static function getUsersWithAward($id) {
        $users = DB::table('user_awards')
            ->leftJoin('users', 'user_awards.user', '=', 'users.id')
            ->where('user_awards.award', '=', $id)
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.user_status')
            ->get()
            ->toArray();
        return array_values($users);

    }
}

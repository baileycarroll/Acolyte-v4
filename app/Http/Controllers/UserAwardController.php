<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAwardController extends Controller
{
    public static function getUsersWithAward($id) {
        $users = DB::table('user_awards')
            ->leftJoin('users', 'user_awards.user', '=', 'users.id')
            ->where('user_awards.award', '=', $id)
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.user_status')
            ->get()
            ->toArray();
        return array_values($users);

    }
    public static function getUsersAwards($user){
        $awards = DB::table('user_awards')
            ->leftJoin('awards', 'user_awards.award', '=', 'awards.id')
            ->where('user_awards.user', '=', $user)
            ->select('awards.id', 'awards.name', 'awards.description', 'user_awards.updated_at')
            ->get()
            ->toArray();
        return array_values($awards);
    }
}

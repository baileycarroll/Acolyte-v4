<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Classes;
use App\Models\Content_Types;
use App\Models\Course;
use App\Models\User_Content;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
   public static function showCourseCatalog() {
       return view('sessions.user.course_catalog', [
           'courses' => Course::filter(request(['category', 'search']))->get(),
           'categories' => Category::all(),
           'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
       ]);
   }
   public static function showClassCatalog() {
       return view('sessions.user.class_catalog', [
           'classes' => Classes::filter(request(['category', 'search']))->get(),
           'categories' => Category::all(),
           'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
       ]);
   }
}

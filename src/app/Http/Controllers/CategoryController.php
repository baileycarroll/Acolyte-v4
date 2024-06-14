<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request) {
        $category = new Category;
        $category->name = $request->category_name;
        $category->save();
        return redirect('/categories')->with('status', 'Category Created!');
    }
    public function updateCategory(Request $request) {
        $category = Category::findOrFail($request->category_id);
        $category->name = $request->category_name;
        $category->save();
        return redirect('/categories')->with('status', 'Category Updated!');
    }
    public function deleteCategory(Request $request){
        $category = Category::findOrFail($request->category_id);
        $category->delete();
        return redirect('/categories')->with('status', 'Category Deleted!');
    }
    public static function showCategories() {
        return view('sessions.admin.categories', ['categories' => Category::all()]);
    }
    public static function categoryInformation($id) {
        return view('sessions.admin.category_information', ['category' => Category::find($id)]);
    }
    public static function categoryInformationRead($id) {
        return view('sessions.admin.category_information_readonly', ['category' => Category::find($id)]);
    }
}

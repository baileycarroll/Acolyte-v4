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
}

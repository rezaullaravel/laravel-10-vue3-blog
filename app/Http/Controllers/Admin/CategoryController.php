<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all category
    public function index(){
        $categories = Category::orderBy('id','desc')->paginate(2);
        return response()->json($categories);
    }


    //store category
    public function store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
    }//end method


    //edit category
    public function edit($id){
        $category = Category::find($id);
        return response()->json([
            'category'=>$category
        ]);
    }//end method


    //category update
    public function update(Request $request,$id){
        $request->validate([
            'category_name'=>'required|unique:categories,category_name,'.$id,
        ]);
       $category = Category::find($id);
       $category->category_name = $request->category_name;
       $category->save();
    }//end method


    //category delete
    public function delete($id){
        Category::find($id)->delete();
    }//end method
}

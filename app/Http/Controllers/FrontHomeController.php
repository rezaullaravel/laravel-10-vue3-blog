<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    //home page
    public function index(){

         return view('frontend.home');
    }//end method


    //get all blog
    public function allBlogs(){
        $blogs = Blog::with('category')->orderBy('id','desc')->get();
        return response()->json($blogs);
    }//end method


    //get all categories
    public function allCategories(){
        $categories = Category::with('blogs')->get();
        return response()->json($categories);
    }//end method


    //category wise blog
    public function categoryWiseBlog($id){
        $blogs = Blog::where('category_id',$id)->with('category')->orderBy('id','desc')->get();
        return response()->json($blogs);
    }//end methd


    //single blog
    public function singleBlog($id){
        $blog = Blog::where('id',$id)->with('category')->orderBy('id','desc')->first();
        return response()->json($blog);
    }//


    //search blog
    public function searchBlog($string){
        $blog = Blog::where('title','LIKE','%'.$string.'%')->get();
        return response()->json($blog);
    }//end method
}

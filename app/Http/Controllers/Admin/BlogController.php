<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    //all blog
    public function index(){
        $blogs = Blog::with('category')->orderBy('id','desc')->paginate(2);
        return response()->json($blogs);
    }//end method


    //get all categoires
    public function categories(){
        $categories = Category::all();
        return response()->json($categories);
    }//end method


    //create blog
    public function store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image',
        ],[
            'category_id.required'=>'Category is required',
            'title.required'=>'Title is required',
            'description.required'=>'Description is required',
            'image.required'=>'Image is required',
            'image.image'=>'File must be image type',
        ]);

         //image upload
         if($request->file('image')){
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/blog_images/',$imageName);
            $imageUrl = 'upload/blog_images/'.$imageName;
        }

        $blog = new Blog();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = 'Admin';
        $blog->image =  $imageName;
        $blog->save();
        return response()->json();
    }//end method


    //get blog by id
    public function getBlogById($id){
        $blog = Blog::find($id);
        return response()->json([
            'blog'=>$blog
        ]);
    }//end method


    public function update(Request $request,$id){
        $blog = Blog::find($id);
        $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'image'=>'image',
        ],[
            'category_id.required'=>'Category is required',
            'title.required'=>'Title is required',
            'description.required'=>'Description is required',
            'image.image'=>'File must be image type',
        ]);

         //image upload
         if($request->file('image')){
            if(File::exists('upload/blog_images/'.$blog->image)){
                unlink('upload/blog_images/'.$blog->image);
            }
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            $image->move('upload/blog_images/',$imageName);
            $imageUrl = 'upload/blog_images/'.$imageName;
            $blog->image =  $imageName;
        }

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();
        return response()->json();
    }//end method


    //delete blog
    public function delete($id){
        $blog = Blog::find($id);
        if(File::exists('upload/blog_images/'.$blog->image)){
            unlink('upload/blog_images/'.$blog->image);
        }
        $blog->delete();
    }//end method
}

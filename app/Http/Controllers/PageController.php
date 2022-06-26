<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
       
        $posts=Post::when(request()->search,function($query){
            $searchKey=request()->search;
            $query->whereHas("tags",function($query) use($searchKey){
                $query->with("post_tag.tag_id")->where("post_tag.tag_id",$searchKey);
            })
            ->orWhere("title","LIKE","%$searchKey%")->orWhere("description","LIKE","%$searchKey%");})
            ->with(["tags"])->latest()->paginate(10);
        return view("index",compact("posts"));
    }

    public function show(Request $request){
        $post=Post::where("slug","$request->slug")->with(["tags","galleries"])->first();
        return view("Post.detail",compact("post"));
    }

    public function search(Request $request){
        
    }
}

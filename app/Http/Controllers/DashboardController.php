<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        return $this->middleware("auth");
    }
    public function index(){
        $posts=Post::all();
        return view("Dashboard.index",compact("posts"));
    }
    public function create(){
        return view("Dashboard.create");
    }
    public function lists(){
        return view("Dashboard.list");
    }
}

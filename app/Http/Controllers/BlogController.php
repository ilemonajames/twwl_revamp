<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function all_blogs()
    {
        $blogs = Blog::all()->sortByDesc('created_at');
        return view('blogs.our-blog', compact('blogs'));
    }

    public function details($id){
        $blog = Blog::find($id);
        $blogs = Blog::all()->sortByDesc('created_at')->take(4);
        return view('blogs.blog-details',compact('blog','blogs'));
    }
}

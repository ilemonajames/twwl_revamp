<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function all_blogs()
    {
        $blogs = Blog::all();
        return view('blogs.our-blog', compact('blogs'));
    }

    public function details($id){
        $blog = Blog::find($id);
        $blogs = Blog::all();
        return view('blogs.blog-details',compact('blog','blogs'));
    }
}

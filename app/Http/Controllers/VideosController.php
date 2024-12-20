<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast; // Assuming you have a Podcast model

class VideosController extends Controller
{
    public function index(){
        $videos = Podcast::where('category', 'Videos')->get(); // Fetch all podcasts
        //dd($podcasts);
        return view('pages.videos', compact('videos'));
        return view('informations.video');
    }

    //
}

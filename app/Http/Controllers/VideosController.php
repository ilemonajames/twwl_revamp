<?php

namespace App\Http\Controllers;

use App\Models\Podcast; // Assuming you have a Podcast model

class VideosController extends Controller
{
    public function index()
    {
        $videos = Podcast::where('category', 'Videos')->get(); // Fetch all podcasts

        // dd($podcasts);
        return view('pages.videos', compact('videos'));

        return view('informations.video');
    }

    public function show($id)
    {
        $podcast = Podcast::where('category', 'Videos')->findOrFail($id);

        return view('pages.podcast-details', compact('podcast'));
    }
}

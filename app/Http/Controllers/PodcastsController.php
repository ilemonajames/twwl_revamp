<?php

namespace App\Http\Controllers;

use App\Models\Podcast; // Assuming you have a Podcast model

class PodcastsController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::where('category', 'Podcast')->get(); // Fetch all podcasts

        // dd($podcasts);
        return view('pages.podcasts', compact('podcasts'));
    }

    public function show($id)
    {
        $podcast = Podcast::where('category', 'Podcast')->findOrFail($id);

        return view('pages.podcast-details', compact('podcast'));
    }
}

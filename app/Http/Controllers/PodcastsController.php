<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast; // Assuming you have a Podcast model

class PodcastsController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::all(); // Fetch all podcasts
        return view('pages.podcasts', compact('podcasts'));
    }

    public function show($id)
    {
        $podcast = Podcast::findOrFail($id); // Fetch specific podcast by ID
        return view('pages.podcast-details', compact('podcast'));
    }
}

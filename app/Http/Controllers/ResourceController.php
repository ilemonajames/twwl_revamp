<?php

namespace App\Http\Controllers;

class ResourceController extends Controller
{
    public function index()
    {
        return view('pages.resources');
    }

    public function videos()
    {
        return app(VideosController::class)->index();
    }

    public function podcasts()
    {
        return app(PodcastsController::class)->index();
    }

    public function books()
    {
        return view('products.index');
    }
}

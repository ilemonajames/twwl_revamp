<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with banner, featured services, and about section.
     */
    public function index()
    {
        // Fetch featured services, for example, the top 3 services
        $services = Service::take(3)->get();
        $programs = Program::take(6)->get();

        // Static banner and about us content
        $bannerText = "Welcome to The Way We Love Relationship Counseling";
        $aboutUsText = "At The Way We Love Relationship Counseling, we strive to help individuals, couples, and families achieve mental health and well-being through self-care and identifying value systems that bring balance and happiness in their relationships. Our founder, Elizabeth Hall, is dedicated to fostering secure connections and helping you grow through holistic therapeutic services.";

        // Return view with data
        return view('home.landing', [
            'bannerText' => $bannerText,
            'services' => $services,
            'programs' => $programs,
            'aboutUsText' => $aboutUsText,
        ]);
    }
}

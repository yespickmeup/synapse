<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Banner;
use App\Service;
use App\Client;
use App\Portfolio;
use App\Testimonial;
use App\TeamMember;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function index2()
    {
        $setting = Setting::all()->first();
        $banners = Banner::all();
        $services = Service::all();
        $clients = Client::all();
        $portfolios = Portfolio::all();
        $testimonials = Testimonial::all();
        $team_members = TeamMember::all();
        return view('welcome',compact('setting','banners','services','clients','portfolios','testimonials','team_members'));
    }
}

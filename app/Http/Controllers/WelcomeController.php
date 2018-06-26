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
class WelcomeController extends Controller
{
    public function index()
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

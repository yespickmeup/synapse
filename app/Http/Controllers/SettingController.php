<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Http\Requests;
use App\Http\Resources\Setting as SettingResource;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Get Setting
        $setting = Setting::all()->first();
        $banners = \App\Banner::all();

        return view('settings',compact('setting','banners'));
       
    }

    public function index2()
    {

        //Get Settings
        $setting = Setting::all()->first();    
        return view('settings.about',compact('setting'));
       
    }
    public function index3()
    {
        //Get Settings
        $settings = Setting::all();
        return response()->json($settings);
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $setting = Setting::findOrFail($id);

        $setting->business_name = $request->business_name;
        $setting->address = $request->address;
        $setting->phone_number = $request->phone_number;
        $setting->email = $request->email;
        $setting->slogan = $request->slogan;
        $setting->call_to_action_description = $request->call_to_action_description;
        $setting->contact_us_description = $request->contact_us_description;

        if($setting->save()){
            return $setting;
        }
        return 'Failed to updated';
    }

    public function update_about(Request $request)
    {
        $id = $request->id;
        $setting = Setting::findOrFail($id);

        $setting->about_title = $request->about_title;
        $setting->about_description = $request->about_description;

        if($setting->save()){
            return $setting;
        }
        return 'Failed to updated';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

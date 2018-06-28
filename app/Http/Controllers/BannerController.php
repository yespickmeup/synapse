<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all banners
        $banners = Banner::all();

        return response()->json($banners);
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
        $banner = new Banner;
        $banner->banner_img = '/images/banners/blank.png';
        if($request->hasFile('banner_file')){
            $imagename = $request->banner_file->getClientOriginalName();
            $request->banner_file->storeAs('public/images/banners',$imagename);
            $banner->banner_img = '/images/banners/'.$imagename;
        }
        if($banner->save()){
            return $banner;
        }
        return 'Failed to add';
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
    public function update(Request $request, $id)
    {

        if($request->hasFile('banner_file')){
            $data = json_decode($request->data);
            $banner = Banner::findOrFail($id);
            $imagename = $request->banner_file->getClientOriginalName();
            $request->banner_file->storeAs('public/images/banners',$imagename);
            $banner->banner_img = '/images/banners/'.$imagename;
            if($banner->save()){
                return $banner;
            }
            return 'Failed to update';
        }
      
       
        return 'Failed to upload';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if($banner->delete()){
            return $banner;
        }
        return 'Failed to delete';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use App\Http\Controllers\UploadController;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return $testimonials;
    }
    public function index2()
    {
        $testimonials = Testimonial::all();
        return view('settings.testimonials',compact('testimonials'));
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
    public function store(Request $request,UploadController $upload)
    {
        $data = json_decode($request->data);
        $testimonial = new Testimonial;
        $testimonial->name = $data->name;
        $testimonial->company = $data->company;
        $testimonial->designation = $data->designation;
        $testimonial->message = $data->message;
        $testimonial->photo = '/images/testimonials/blank.png';

        if($request->hasFile('testimonial_file')){
            // $file = $request->testimonial_file;
            // $path = "/public/images/testimonials/";
            // $file_path = $upload->uploadFile($file,$path);
            // $file_path = str_replace('/public','',$file_path);
            // $testimonial->photo = $file_path;

            $imagename = $request->testimonial_file->getClientOriginalName();
            $request->testimonial_file->storeAs('public/images/testimonials',$imagename);
            $testimonial->photo = '/images/testimonials/'.$imagename;
        }
        if($testimonial->save()){
            return $testimonial;
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
    public function update(Request $request, $id, UploadController $upload)
    {
        $data = json_decode($request->data);
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $data->name;
        $testimonial->company = $data->company;
        $testimonial->designation = $data->designation;
        $testimonial->message = $data->message;
        if($request->hasFile('testimonial_file')){
            // $file = $request->testimonial_file;
            // $path = "/public/images/testimonials/";
            // $file_path = $upload->uploadFile($file,$path);
            // $file_path = str_replace('/public','',$file_path);
            // $testimonial->photo = $file_path;

            $imagename = $request->testimonial_file->getClientOriginalName();
            $request->testimonial_file->storeAs('public/images/testimonials',$imagename);
            $testimonial->photo = '/images/testimonials/'.$imagename;
        }
      
        if($testimonial->save()){
            return $testimonial;
        }
        return 'Failed to update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if($testimonial->delete()){
            return $testimonial;
        }
        return 'Failed to delete';
    }
}

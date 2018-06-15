<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(ImageUploadRequest $request){

        if($request->hasFile('image')){
            $imagename = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images/banners',$imagename);
            $banner_id = $request->banner_id;
            $banner = \App\Banner::findOrFail($banner_id);
            $banner->banner_img = '/images/banners/'.$imagename;
            $banner->save();
            return back();
        }
        
        // if($request->hasFile('image')){

        //     $image       = $request->file('image');
        //     $filename    = $image->getClientOriginalName();

        //     $image_resize = Image::make($image->getRealPath());              
        //     $image_resize->resize(1000, 500);
        //     $image_resize->save('public/images/banners/' .$filename);

        //     $banner_id = $request->banner_id;
        //     $banner = \App\Banner::findOrFail($banner_id);
        //     $banner->banner_img = '/images/banners/'.$filename;
        //     $banner->save();
        //     return back();
        // }

        return 'Failed to upload!';
    }
}

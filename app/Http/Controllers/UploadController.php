<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
  
    
    public function upload(Request $request){
        if($request->hasFile('image')){
            $imagename = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images/banners',$imagename);
            $banner_id = $request->banner_id;
            $banner = \App\Banner::findOrFail($banner_id);
            $banner->banner_img = '/images/banners/'.$imagename;
            if($banner->save()){
                return $banner;
            }else{
                return "failed to update";
            }
        }
        return response()->json(['message:'=>'failed to upload','image'=>$request->image]);
    }
}

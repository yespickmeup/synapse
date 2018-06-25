<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadFile($file,$path){
        $imagename = $file->getClientOriginalName();
        $imagename_woe = substr($imagename, 0 , (strrpos($imagename, ".")));
        $extension = $file->getClientOriginalExtension();
        $img_path = $path.$imagename;

        $new_imgname = '';
        if(!Storage::exists($img_path)){
            $exists= 'No';
            $imagename = $file->getClientOriginalName();
            $file->storeAs($path,$imagename);
            return $path.$imagename;
        }else{
            $loop = 0;
            $i = 1;
            do{
                $new_imgname = $imagename_woe.'_'.$i.'.'.$extension;
                $img_path = $path.$new_imgname;
                if(!Storage::exists($img_path)){
                    $file->storeAs($path,$new_imgname);
                    return $path.$new_imgname;
                    $loop =1; 
                }
                $i++;
            }while($loop === 0);
        }

    }
    
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

        return response()->json(['message:'=>'failed to upload','image'=>$request->image]);
    }
}

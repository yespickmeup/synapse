<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return $clients;
    }
    public function index2()
    {
        $clients = Client::all();
        return view('settings.clients', compact('clients'));
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
        
        $data = json_decode($request->data);
        
        
        $img_path = '';
        $exists = 'Yes';
        $client = new Client;
        $client->client_name = $data->client_name;
        $client->client_contact_no = $data->client_contact_no;
        $client->client_address = $data->client_address;
        $client->client_logo = '/images/clients/blank.png';

        
        if($request->hasFile('client_file')){
            $file = $request->client_file;
            $path = "/public/images/clients/";
            $file_path = $this->uploadFile($file,$path);
            $file_path = str_replace('/public','',$file_path);
            $client->client_logo = $file_path;
        }
        if($client->save()){
            return $client;
        }
        return 'Failed to add';
    }


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


    public function store2(Request $request)
    {
        $client = new Client;
        $client->client_name = $request->client_name;
        $client->client_contact_no = $request->client_contact_no;
        $client->client_address = $request->client_address;
        $client->client_logo = $request->client_logo;
        if($client->save()){
            return $client;
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
        $client = Client::findOrFail($id);
        $client->client_name = $request->client_name;
        $client->client_contact_no = $request->client_contact_no;
        $client->client_address = $request->client_address;
        $client->client_logo = $request->client_logo;
        if($client->save()){
            return $client;
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
        $client = Client::findOrFail($id);
        if($client->delete()){
            return $client;
        }
        return 'Failed to delete';
    }
}

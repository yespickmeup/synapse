<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Controllers\UploadController;
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
    public function store(Request $request, UploadController $upload)
    {
       
        $data = json_decode($request->data);
        $client = new Client;
        $client->client_name = $data->client_name;
        $client->client_contact_no = $data->client_contact_no;
        $client->client_address = $data->client_address;
        $client->client_logo = '/images/clients/blank.png';

        
        if($request->hasFile('client_file')){
            // $file = $request->client_file;
            // $path = "/public/images/clients/";
            // $file_path = $upload->uploadFile($file,$path);
            // $file_path = str_replace('/public','',$file_path);
            // $client->client_logo = $file_path;

            $imagename = $request->client_file->getClientOriginalName();
            $request->client_file->storeAs('public/images/clients',$imagename);
            $client->client_logo = '/images/clients/'.$imagename;
        }
        if($client->save()){
            return $client;
        }
        return 'Failed to add';
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
    public function update(Request $request, $id, UploadController $upload)
    {
        $data = json_decode($request->data);
        $client = Client::findOrFail($id);
        $client->client_name = $data->client_name;
        $client->client_contact_no = $data->client_contact_no;
        $client->client_address = $data->client_address;
        if($request->hasFile('client_file')){
            // $file = $request->client_file;
            // $path = "/public/images/clients/";
            // $file_path = $upload->uploadFile($file,$path);
            // $file_path = str_replace('/public','',$file_path);
            // $client->client_logo = $file_path;

            $imagename = $request->client_file->getClientOriginalName();
            $request->client_file->storeAs('public/images/clients',$imagename);
            $client->client_logo = '/images/clients/'.$imagename;
        }
      
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

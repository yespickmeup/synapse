<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use App\Http\Controllers\UploadController;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = TeamMember::all();
        return $team_members;
    }
    public function index2()
    {
        $team_members = TeamMember::all();
        return view('settings.team',compact('team_members'));
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
        return $request->all();
        // $data = json_decode($request->data);
        // $team = new TeamMember;
        // $team->name = $data->name;
        // $team->designation = $data->designation;
        // $team->twitter_account = $data->twitter_account;
        // $team->facebook_account = $data->facebook_account;
        // $team->google_account = $data->google_account;
        // $team->linkedin_account = $data->linkedin_account;

        // $team->photo = '/images/team/blank.png';

        // if($request->hasFile('team_file')){
        //     $file = $request->team_file;
        //     $path = "/public/images/team/";
        //     $file_path = $upload->uploadFile($file,$path);
        //     $file_path = str_replace('/public','',$file_path);
        //     $team->photo = $file_path;
        // }
        // if($team->save()){
        //     return $team;
        // }
        // return 'Failed to add';
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
        $team = TeamMember::findOrFail($id);
        $team->name = $data->name;
        $team->designation = $data->designation;
        $team->twitter_account = $data->twitter_account;
        $team->facebook_account = $data->facebook_account;
        $team->google_account = $data->google_account;
        $team->linkedin_account = $data->linkedin_account;

        if($request->hasFile('team_file')){
            $file = $request->team_file;
            $path = "/public/images/team/";
            $file_path = $upload->uploadFile($file,$path);
            $file_path = str_replace('/public','',$file_path);
            $team->photo = $file_path;
        }
      
        if($team->save()){
            return $team;
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
        $team = TeamMember::findOrFail($id);
        if($team->delete()){
            return $team;
        }
        return 'Failed to delete';
    }
}

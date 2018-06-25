<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Http\Controllers\UploadController;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();
        return $portfolios;
    }
    public function index2()
    {
        $portfolios = Portfolio::all();
        return view('settings.portfolios',compact('portfolios'));
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
        $portfolio = new Portfolio;
        $portfolio->title = $data->title;
        $portfolio->description = $data->description;
        $portfolio->portfolio_type = $data->portfolio_type;
        $portfolio->portfolio_img = '/images/portfolios/blank.png';

        if($request->hasFile('portfolio_file')){
            $file = $request->portfolio_file;
            $path = "/public/images/portfolios/";
            $file_path = $upload->uploadFile($file,$path);
            $file_path = str_replace('/public','',$file_path);
            $portfolio->portfolio_img = $file_path;
        }
        if($portfolio->save()){
            return $portfolio;
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
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->title = $data->title;
        $portfolio->description = $data->description;
        $portfolio->portfolio_type = $data->portfolio_type;
        if($request->hasFile('portfolio_file')){
            $file = $request->portfolio_file;
            $path = "/public/images/portfolios/";
            $file_path = $upload->uploadFile($file,$path);
            $file_path = str_replace('/public','',$file_path);
            $portfolio->portfolio_img = $file_path;
        }
      
        if($portfolio->save()){
            return $portfolio;
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
        $portfolio = Portfolio::findOrFail($id);
        if($portfolio->delete()){
            return $portfolio;
        }
        return 'Failed to delete';
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OpenProjectModel;
use Illuminate\Http\Request;

class OpenProjectAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \App\Models\OpenProjectModel  $openProjectModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       // OpenProjectModel::syncOpenProjectUsers();
        OpenProjectModel::syncOpenProjectsTask();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpenProjectModel  $openProjectModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpenProjectModel $openProjectModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpenProjectModel  $openProjectModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpenProjectModel $openProjectModel)
    {
        //
    }
}

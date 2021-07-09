<?php

namespace App\Http\Controllers;

use App\Models\PicklistModel;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;

class PicklistController extends Controller
{
    use ResponseTrait;
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
     * @param  \App\Models\PicklistModel  $picklistModel
     * @return \Illuminate\Http\Response
     */
    public function show(PicklistModel $picklistModel)
    {
        $activeUsers=PicklistModel::getActiveUsers();
        $statusList=PicklistModel::getTaskStatus();
        $reviewStatusList=PicklistModel::getReviewStatus();
        $checklistMainCategory=PicklistModel::getChecklistMainCategories();
        $data=[
            'users'=>$activeUsers,
            'taskStatus'=>$statusList,
            'reviewStatus'=>$reviewStatusList,
            'mainCategories'=>$checklistMainCategory
        ];
        $status=200;
        return $this->sendSuccessResponse($status,$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PicklistModel  $picklistModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PicklistModel $picklistModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PicklistModel  $picklistModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PicklistModel $picklistModel)
    {
        //
    }
}

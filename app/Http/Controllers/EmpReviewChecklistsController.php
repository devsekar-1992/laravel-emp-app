<?php

namespace App\Http\Controllers;

use App\Models\EmpReviewChecklist;
use Illuminate\Http\Request;
use App\Http\Resources\EmpReviewChecklistResource;
use App\Http\Traits\ResponseTrait;

class EmpReviewChecklistsController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=EmpReviewChecklist::with(['getMainCategory','getMainCategory.getTaskReviewType'])->get();
        if(!empty($data)){
        return $this->sendSuccessResponse(200,EmpReviewChecklistResource::collection($data));
        } else {
            return $this->sendCustomMessage(404,'Sorry! No record found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=EmpReviewChecklist::storeReviewChecklist($request->all());
        if($data['status']) {
            return $this->sendSuccessResponse(200,$data);
        } else {
            return $this->sendCustomMessage(500,'Failed to insert record');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpReviewChecklistMainCategory  $empReviewChecklistMainCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EmpReviewChecklist $empReviewChecklist)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpReviewChecklistMainCategory  $empReviewChecklistMainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpReviewChecklistMainCategory $empReviewChecklistMainCategory)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpReviewChecklistMainCategory  $empReviewChecklistMainCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpReviewChecklistMainCategory $empReviewChecklistMainCategory)
    {
        $data=EmpReviewChecklist::storeReviewChecklist($request->all(),'update');
        if(count($data)) {
            return $this->sendSuccessResponse(200,$data);
        } else {
            return $this->sendCustomMessage(500,'Failed to update record');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpReviewChecklistMainCategory  $empReviewChecklistMainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data=EmpReviewChecklist::deleteReviewChecklist($request->all());
        if(count($data)) {
            return $this->sendSuccessResponse(200,$data);
        } else {
            return $this->sendCustomMessage(500,'Failed to delete record');
        }
    }
}

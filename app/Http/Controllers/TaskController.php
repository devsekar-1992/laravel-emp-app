<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskListResource;
use App\Http\Resources\TaskResourceCollection;
use App\Http\Resources\TaskReviewEdit;
use App\Models\Task;
use App\Http\Traits\ResponseTrait;

class TaskController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskList = Task::with
        (
            [
            'taskVersionInfo',
            'userTaskAssignee',
            'user',
            'taskVersionInfo',
            'taskVersionInfo.projectInfo'
            ]
        )->get();
        if(!empty($taskList)){
            return $this->sendSuccessResponse(200,TaskListResource::collection($taskList));
        } else {
            return $this->sendCustomMessage(404,'Sorry! No record found');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $validatedRequest = $request->validated();
        $saveResult = Task::saveTask($validatedRequest);
        return [
            'result' => $saveResult,
        ];
    }
    /**
     * Edit the task review
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
      $taskReviewDetail=Task::getTaskReviewDetails($request->all());
      $data=TaskReviewEdit::collection($taskReviewDetail);
      return $this->sendSuccessResponse(200,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskModel  $taskModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $data=Task::with([
            'userTaskAssignee',
            'user',
            'taskVersionInfo',
            'taskVersionInfo.projectInfo',
            'taskreviewmodel',
            'taskreviewmodel.reviewtype',
            'taskreviewmodel.reviewStatus',
            'taskreviewmodel.user'
        ])->find($request->get('id'));
        if(!empty($data)){
            $status=200;
            $data = new TaskResourceCollection($data);
            return $this->sendSuccessResponse($status,$data);
        } else {
            return $this->sendCustomMessage(404,'Sorry! No record found');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskModel  $taskModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $taskModel)
    {
        $isUpdated=Task::saveTaskReviewModel($request);
        if($isUpdated) {
            if($request['request_method']=='add') {
                $message='Task Review Has Been Added';
            } else {
                $message='Updated Successfully';
            }
            $status=200;
            return $this->sendSuccessResponse($status,$message);
        } else {
            return $this->sendCustomMessage(500,'Sorry! Failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskModel  $taskModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $taskModel)
    {
        //
    }
}

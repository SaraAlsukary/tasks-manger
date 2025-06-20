<?php

namespace Package\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use Package\Tasks\Http\Requests\TaskRequest;
use Package\Tasks\ApiResources\TaskResource;
use Package\Tasks\ApiResources\MemberResource;
use App\Models\User;
use Package\Tasks\Models\Task;
use App\Http\Controllers\Controller;
use Package\Tasks\Models\Team;
use Package\Tasks\Models\Member;

// use App\Events\NotifyEvent;

use Package\Tasks\Models\Proirity;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Task::with('proirity','member','team.members')->get();
        return response()->json(['tasks'=>TaskResource::collection($tasks)]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {

          $task =  Task::create($request->validated());

          return response()->json([
                'task'=> new TaskResource($task->load('proirity','team.members','member')),
                 'message'=>'added successfully!'
          ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $members = Team::findOrFail($task->team_id)->members;
        return response()->json([
        'member'=> new MemberResource($member),
        'task'=> new TaskResource($task->load('proirity','team.members','member')),
        ]);
    }
    public function addMember(Request $request,Task $task){
          $is_exist = false;
        foreach ($task->team->members as $member) {

           if($member->id == $request->user_id){
                 $is_exist = true;
             }
        }
        if(!$is_exist){
            return response()->json([
                'message'=>"this member isn't in task team",
            ]);
        }else{
            $task->update(['user_id'=>$request->user_id]);
            return response()->json([
            'task'=> new TaskResource($task->load('proirity','team.members','member')),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        //
        $task = Task::with('proirity','team.members','member')->find($id);
        $task->update($request->all());
          return response()->json([
          'task'=> new TaskResource($task),
            'message'=>'edited successfully!'
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::with('proirity','team.members','member')->find($id);
        $task->delete();
        return response()->json([
        'task'=> new TaskResource($task),
         'message'=>'deleted successfully!'
        ]);
    }
}

<?php

namespace Package\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use Package\Tasks\Models\Task;
use Package\Tasks\ApiResources\TaskResource;
use Package\Tasks\ApiResources\TeamResource;
use Package\Tasks\ApiResources\MemberResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Package\Tasks\Models\Team;
class ManageController extends Controller
{
    public function tasks(){
        $tasks = User::findOrFail(auth()->user()->id)->tasks()->get();
        return response()->json(['tasks'=>TaskResource::collection($tasks)]);
    }
    public function teams(){
            $teams = User::findOrFail(auth()->user()->id)->teams()->get();
            return response()->json(['teams'=>TeamResource::collection($teams)]);
        }
    public function members(string $id){
            $team = Team::findOrFail($id);
            $is_manger = false;
            $array = [];
            $members = [];
            $users = $team->members()->get();
             foreach($users as $user){
                if(auth()->user()->id===$user->id && $user->pivot->is_manger===1)
                    $is_manger = true;
                if($user->id===auth()->user()->id)
                    continue;
                else
                    $members = [...$array,$user];

             }
        return response()->json(['team'=>$team,'team_members'=>MemberResource::collection($members),'is_manger'=>$is_manger]);
    }

    public function changeStatue(Request $request,Task $task){
        $task->update([
            'statue'=> $request->statue
        ]);

        return response()->json(["message"=>"succefully updated","task"=>new TaskResource($task)]);
    }

}

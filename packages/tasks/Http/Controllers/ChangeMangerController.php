<?php

namespace Package\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Package\Tasks\Models\Team;
class ChangeMangerController extends Controller
{
    public function manger( Team $team,User $member ){

        foreach($team->members as $teamMember){
          $is_manger = $teamMember->teams()->where('team_id',$team->id)->first()->pivot->is_manger;
            if(($is_manger===1 )&& ($teamMember->id !== $member->id))
            return redirect()->back()->with('message','this team has manger already');
        }

        if(!$team->members()->where('user_id',$member->id)->exists()){
        return back()->with('message','Member Not In This Team');
        }
        $currentStatue = $team->members()->where('user_id',$member->id)
        ->first()
        ->pivot
        ->is_manger;
        $team->members()->updateExistingPivot($member->id,[
            'is_manger'=> $currentStatue ===0?1:0
        ]);


        return response()->json(['message'=>'Successfully updated the manger','is_manger'=>$is_manger]);
    }
}

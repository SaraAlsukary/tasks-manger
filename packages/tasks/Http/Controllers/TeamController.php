<?php

namespace Package\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use Package\Tasks\ApiResources\TeamResource;
use Package\Tasks\Http\Requests\TeamRequest;
use Package\Tasks\Models\Team;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
 {
 //

    $teams = Team::with('members')->get();
    return response()->json(['teams'=>TeamResource::collection($teams)]);
 }

 public function store(TeamRequest $request)
 {
 //
         $team =  Team::create([
                 "name"=>$request->name,
                  "description"=>$request->description,
          ]);
         return response()->json([
                 'team'=> new TeamResource($team),
                  'message'=>'added successfully!'
            ]);
 }


 /**
 * Display the specified resource.
 */
 public function show( Team $team)
 {

        return response()->json([
        'team'=> new TeamResource($team),

        ]);
 }


 /**
 * Update the specified resource in storage.
 */
 public function update(TeamRequest $request, string $id)
 {
 //
        $team = Team::findOrFail($id);
        $team->update($request->all());
              return response()->json([
              'team'=> new TeamResource($team),
              'message'=>'edited successfully!'

              ]);

 }

 /**
 * Remove the specified resource from storage.
 */
 public function destroy(string $id)
 {
 //
        $team = Team::findOrFail($id);
        $team->delete();
        return response()->json([
        'team'=> new TeamResource($team),
        'message'=>'deleted successfully!'

        ]);

 }
}
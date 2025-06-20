<?php

namespace Package\Tasks\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Package\Tasks\ApiResources\MemberResource;
use Package\Tasks\Http\Requests\MemberRequest;
use App\Http\Controllers\Controller;
use Package\Tasks\Models\Member;
use Package\Tasks\Models\Team;
use Illuminate\Support\Facades\Hash;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = User::with('teams')->where('role',"user")->get();
        return response()->json(['members'=>MemberResource::collection($members)]);
     }

    /**
    * Store a newly created resource in storage.
    */
    public function store(MemberRequest $request)
    {
    //
    $member = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
    ]);
    $member->teams()->attach($request->teams);
        return response()->json([
        'member'=> new MemberResource($member),
        'message'=>'added successfully!'
        ]);
    }

    /**
    * Display the specified resource.
    */
    public function show( User $member)
    {
     return response()->json([
     'member'=> new MemberResource($member),
     ]);
  }


    /**
    * Update the specified resource in storage.
    */
    public function update(MemberRequest $request, string $id)
    {
    //
                $member = User::with('teams')->findOrFail($id);
                $member->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'role'=> 'user',
                    'password'=>Hash::make($request->password),
                ]);
                 $member->teams()->sync($request->teams);
            return response()->json([
            'member'=> new MemberResource($member),
            'message'=>'edited successfully!'
            ]);

    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
    //
    $member = User::findOrFail($id);
    $member->teams()->detach();
    $member->delete();
       return response()->json([
       'member'=> new MemberResource($member),
       'message'=>'deleted successfully!'
       ]);

    }
}

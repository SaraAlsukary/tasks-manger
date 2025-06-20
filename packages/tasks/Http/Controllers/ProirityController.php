<?php

namespace Package\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use Package\Tasks\Http\Requests\ProirityRequest;
use Package\Tasks\ApiResources\ProirityResource;
use App\Http\Controllers\Controller;
use Package\Tasks\Models\Proirity;
class ProirityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $proirities = Proirity::all();
        return response()->json(['proirities'=>ProirityResource::collection($proirities)]);
}

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProirityRequest $request)
    {
        //
      $proirity =  Proirity::create($request->all());
        return response()->json([
            'proirity'=> new ProirityResource($proirity),
             'message'=>'added successfully!'

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( Proirity $proirity)
    {
        //
    ;
         return response()->json([
         'proirity'=> new ProirityResource($proirity),
         ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProirityRequest $request, string $id)
    {
        //
         $proirity = Proirity::findOrFail($id);
         $proirity->update($request->all());
           return response()->json([
             'proirity'=> new ProirityResource($proirity),
             'message'=>'edited successfully!'

            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $proirity = Proirity::findOrFail($id);
         $proirity->delete();
         return response()->json([
            'proirity'=> new ProirityResource($proirity),
            'message'=>'deleted successfully!'

         ]);

    }
}
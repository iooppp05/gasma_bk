<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::all();
        
        return response(['success'=> true, 'communities'=> CommunityResource::collection($communities)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'=> 'required|max:25',
            'address' => 'required|max:100',
            'phone' => 'required|max:10',
            'contact' => 'required|max:50',
            'contact_phone' => 'required|max:10'
        ]);

        if($validator->fails()){
            return response()->json(['error'=> $validator->errors(), 'message'=>'Validation Fail'], 400);
        }

        $community = Community::create($data);
        
        return response(['community'=> new CommunityResource($community), 'message'=> 'Created successfully.'],200);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        return response(['community'=> new CommunityResource($community), 'message'=> "Success."], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        $request->validate([
            'name' => 'required|String|unique:communities,name,'.$community->id.'|max:25',
            'address' => 'required|max:100',
            'phone' => 'required|max:10',
            'contact' => 'required|max:50',
            'contact_phone' => 'required|max:10'
        ]);
        $community->update($request->all());
        
        return response(['community'=> $community, 'message'=> 'Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();
        return response(['success'=>true], 200);
    }
}

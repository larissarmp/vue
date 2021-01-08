<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Group as GroupResource;
use App\Group;

class GroupController extends Controller
{
    public function index()
    { 
        return new GroupResource(Group::with([])->get());
    }

    public function show($id)
    {
        $group = Group::with([])->findOrFail($id);
        return new GroupResource($group);
    }
  
    public function store(Request $request)
    {
        $group = Group::create($request->all());
        
        return (new GroupResource($group))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->all());
        return response()->json($group);
    }

   
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->json($group);
    }
}

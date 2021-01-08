<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Resources\UserFile as UserFileResource;
use App\Http\Controllers\Controller;
use App\UserFile;

class UserFileController extends Controller
{
    public function index()
    {
        return new UserFileResource(UserFile::with(['group'])->get());
        
    }

    public function show($id)
    {
        $user_file = UserFile::with(['group'])->findOrFail($id);
        
        return new UserFileResource($user_file);
    }

    public function store(Request $request)
    {
        $user_file = UserFile::create($request->all());
        
        return (new UserFileResource($user_file))
            ->response()
            ->setStatusCode(201);
    }
  
    public function update(Request $request, $id)
    {
        $result = UserFile::findOrFail($id);
        $result->update($request->all());
        return response()->json($result);
    }

   
    public function destroy($id)
    {
        $result = UserFile::findOrFail($id);
        $result->delete();
        return response()->json($result);
    }

}

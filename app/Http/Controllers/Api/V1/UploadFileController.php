<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UploadFile as UploadFileResource;
use App\UploadFile;
use Illuminate\Http\UploadedFile;

class UploadFileController extends Controller
{
    public function index()
    {
        return new UploadFileResource(Group::with(['userFile'])->get());
    }

    public function show($id)
    {
        $userFile = Group::with(['userFile'])->findOrFail($id);
        return new UploadFileResource($userFile);
    }
  

    public function store(Request $request)
    {
       $data = $request->all();
        
         if ($request->file('url_size')->isValid()){

            $name = uniqid(date('HisYmd'));
            $extension = $request->pdf->extension();
            $nameFile = "{$name}.{$extension}";
            $pdf = $request->pdf->storeAs('url_size',$nameFile);
            $data['url_size'] = $pdf;

        } 
        $result = UploadFile::create($data);

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        if (!$pdfFile = UploadFile::findOrFail($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->pdf && $request->pdf->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->pdf->extension();
            $nameFile = "{$name}.{$extension}";
            $pdf = $request->pdf->store('pdf', $nameFile);
            $data['pdf'] = $pdf;
        }

        $pdf->update($data);
        return response()->json($pdf);
    }

   
    public function destroy($id)
    {
        $result = UploadFile::findOrFail($id);
        $result->delete();
        return response()->json($result);
    }
}

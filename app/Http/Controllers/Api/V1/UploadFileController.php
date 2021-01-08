<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UploadFile as UploadFileResource;
use App\UploadFile;
use Illuminate\Http\UploadedFile;

class FileController extends Controller
{
    public function index()
    {
        return new UploadFileResource(File::with(['userFile'])->get());
    }

    public function show($id)
    {
        $userFile = UploadFile::with(['userFile'])->findOrFail($id);
        return new UploadFileResource($userFile);
    }
  

    public function store(Request $request)
    {
       $data = $request->all();
        
         if ($request->file('pdf')->isValid()){
            $pdf = $request->pdf->store('pdf');
            $data['pdf'] = $pdf;
            
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
            if (Storage::exists($pdfFile->pdf))
                Storage::delete($pdfFile->pdf);

            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->pdf->getClientOriginalExtension();

            $pdf = $request->pdf->storeAs('pdf', $nameFile);
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

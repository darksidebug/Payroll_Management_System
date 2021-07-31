<?php

namespace App\Http\Controllers;

use App\Models\UploadSSSExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UploadSSSExcelController extends Controller
{
    protected $directory='files';
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.upload-sss-csv', ['page' => 'SSS Contribution Schedule']);
    }
    public function messages()
    {
        return [
            'sss-excel.mimes'=>'The uploaded file is not supported. Upload only files with (xls,xlsx) extension'
        ];
    }



    protected function deleteAllFiles()
    {
        $files = Storage::allFiles($this->directory);

        Storage::delete($files);
        
    }

    public function uploadExcel(Request $request)
    {

        
        $request->validate([
            'sss-excel'=>'required|mimes:xls,xlsx',
        ],$this->messages());


        $this->deleteAllFiles($this->directory);

        $path=$request->file('sss-excel')->store($this->directory);


        return back()->with('success','File uploaded successfully!');

 
    }
}
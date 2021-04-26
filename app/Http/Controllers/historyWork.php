<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\history_work;
use Illuminate\Support\Facades\Storage;
use File;
use ZipArchive;

class historyWork extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work = DB::table('history_works')->where('unique_id',$id)->get();
        return view('historyWork',compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download_image(Request $request)
    {
        $id = $request->iddownload;
        $imageWork = DB::table('history_works')->where('unique_id',$id)->get();
        //
        // $url = storage_path('app/public')."/fruit1.jpg";
        // $info = new \SplFileInfo($url);
        // if ($info->isFile()) {
        //     // dd($info->getRealPath());
        //     return Storage::download($info->getRealPath());
        // }
        
        // return Storage::download($url);
        // $file_name = "/fruit1.jpg";
        // // $header = 
        // $path = storage_path('app/public/').$file_name;
        // if (file_exists($path)) {
        //     return response()->download($path);
        // }

        $zip = new ZipArchive;
   
        $fileName = 'historyImage.zip';
        
        if ($zip->open(public_path($fileName), ZipArchive::OVERWRITE) === TRUE)
        {
            $files = File::files(storage_path('app/public'));
            // dd(storage_path('app/public/').'fruit1.jpg');  

            // foreach ($imageWork as $value) {
            //     $file_name = $value->image;
            //     $path = storage_path('app/public/').$file_name;
            //     if (Storage::disk('storage')->exists('file.jpg')) {
            //         dd($image);
            //         $image = Storage::get($value->image);
            //         $zip->addFile($image, $value->image);
            //     }
            // }

            foreach($imageWork as $key => $imageWorks){
                // dd($imageWork);
                foreach ($files as $value){
                    $relativeNameInZipFile = basename($value);
                    // dd($relativeNameInZipFile);
                    if($imageWorks->image == $relativeNameInZipFile) $zip->addFile($value, $relativeNameInZipFile);
                }
            }
            $zip->close();
        }
        // if (file_exists(public_path($fileName))) {
        //     return response()->download(public_path($fileName));
        // }
        return response()->download(public_path($fileName));
    }

    public function showFull() {
        $work = DB::table('history_works')->orderBy('unique_id')->get();
        return view('showFull',compact('work'));
    }
}

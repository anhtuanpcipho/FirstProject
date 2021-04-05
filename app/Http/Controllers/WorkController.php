<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work = Work::all();
        return view('index', compact('work'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'creator' => 'required|max:255',
            'deadline' => 'required|max:255',
            'workdone' => 'required|numeric',
        ]);
        
        $work = new Work();
        $work->title = $storeData['title'];
        $work->creator = $storeData['creator'];
        $work->deadline = $storeData['deadline'];
        $work->workdone = $storeData['workdone'];
        $file = $storeData['image'];
        $destinationPath = storage_path('/app/public');
        $name = $file->getClientOriginalName();
        $file->move($destinationPath, $name);
        $work->image = $name;
        $work->save();
        return redirect('/works')->with('completed', 'Work has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('edit', compact('work'));
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
        $updateData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'creator' => 'required|max:255',
            'deadline' => 'required|max:255',
            'workdone' => 'required|numeric',
        ]);
        $file = $updateData['image'];
        $destinationPath = storage_path('/app/public');
        $name = $file->getClientOriginalName();
        $file->move($destinationPath, $name);
        $updateData['image'] = $name;

        Work::whereId($id)->update($updateData);

        return redirect('/works')->with('completed', 'work has been updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();

        return redirect('/works')->with('completed', 'work has been deleted!!!');
    }

    // Add function for search record!!!
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->get('search');
    
        // Search in the title and body columns from the posts table
        $posts = DB::table('works')
            ->where('id', 'LIKE', "%{$search}%")
            ->orWhere('creator', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('posts'));
    }

    // Add function for livesearch record!!
    public function livesearch(Request $request){
        $inputSearch = $request['inputSearch'];
        $keyResult = DB::table('works')
            ->where('id', 'LIKE', "%{$inputSearch}%")
            ->orWhere('creator', 'LIKE', "%{$inputSearch}%")
            ->get();
        echo $keyResult;
    }
}

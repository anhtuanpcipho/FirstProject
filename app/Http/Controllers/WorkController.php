<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\history_work;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Validator;

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
        $valueSession = session()->get('email');
        //if($valueSession == "")
        if(Gate::denies('log-in', [$valueSession])) {
            //dd(session()->get('email'));
            abort(404);
        }

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
        // dd($request->note[1]);
        $N = count($request->title);

        $storeData = $request->validate([
            'title.*' => 'required|max:255',
            'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'collaborator.*' => 'required|max:255',
            'deadline.*' => 'required|max:255',
            'workdone.*' => 'required|numeric',
        ]);
        

        for($i = 0; $i <= $N-1; $i++) {
            $work = new Work(); $h_work = new history_work();
            $work->title = $storeData['title'][$i]; $h_work->title = $work->title;
            $work->collaborator = $storeData['collaborator'][$i]; $h_work->collaborator = $work->collaborator;
            $work->deadline = $storeData['deadline'][$i]; $h_work->deadline = $work->deadline;
            $work->workdone = $storeData['workdone'][$i]; $h_work->workdone = $work->workdone;
            if($i > 1) {
                $work->note = $request->note[$i-2]; $h_work->note = $work->note;
            }
            $file = $storeData['image'][$i];
            $destinationPath = storage_path('/app/public');
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
            $work->image = $name; $h_work->image = $work->image;
            $work->save(); $h_work->unique_id = $work->id;
            $h_work->save();
        }
        
        return redirect('/works')->with('completed', 'Work has been saved!');
        // dd(response()->json([
            
        // ]));
    }


    public function liveStore(Request $request)
    {
        $valueSession = session()->get('email');
        //if($valueSession == "")
        if(Gate::denies('log-in', [$valueSession])) {
            //dd(session()->get('email'));
            abort(404);
        }
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'collaborator' => 'required|max:255',
            'deadline' => 'required|max:255',
            'workdone' => 'required|numeric',
        ]);

        if($validator->passes()){
            $work = new Work(); $h_work = new history_work();
            $work->title = $request->title; $h_work->title = $request->title;
            $work->collaborator = $request->collaborator; $h_work->collaborator = $request->collaborator;
            $work->deadline = $request->deadline; $h_work->deadline = $request->deadline;
            $work->workdone = $request->workdone; $h_work->workdone = $request->workdone;
            $work->note = $request->note; $h_work->note = $request->note;
            $file = $request->image;
            $destinationPath = storage_path('/app/public');
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
            $work->image = $name; $h_work->image = $name;
            $work->save(); $h_work->unique_id = $work->id; $h_work->save();

            return response()->json(['status'=>1, 
            'msg'=>'Added a new work',
            'id' => $work->id,
            'title' => $work->title,
            'created_at' => $work->created_at->format('Y.m.d H:i:s'),
            'collaborator' => $work->collaborator,
            'image' => $work->image,
            'deadline' => $work->deadline,
            'workdone' => $work->workdone,
            'note' => $work->note
            ]);
        }

        return response()->json(['status'=>0, 'error'=>$validator->errors()->all()]);

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

    public function liveEdit(Request $request)
    {
        $valueSession = session()->get('email');
        //if($valueSession == "")
        if(Gate::denies('log-in', [$valueSession])) {
            //dd(session()->get('email'));
            abort(404);
        }
        $id = $request->id;
        $updateData = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'collaborator' => 'required|max:255',
            'deadline' => 'required|max:255',
            'workdone' => 'required|numeric',
            'note' => '',
        ]);

        if($updateData->passes()){
            $h_work = new history_work();
            $h_work->unique_id = $id; $h_work->collaborator = $request->collaborator;
            $h_work->title = $request->title; $h_work->deadline = $request->deadline;
            $h_work->workdone = $request->workdone; $h_work->note = $request->note;
            $updateWork['image'] = $request->image;
            $file = $updateWork['image'];
            $destinationPath = storage_path('/app/public');
            $name = $file->getClientOriginalName();
            $h_work->image = $name;
            $file->move($destinationPath, $name);
            // dd($updateData);
            Work::where('id', $id)->update([
                'title' => $request->title,
                'image' => $name,
                'collaborator' => $request->collaborator,
                'deadline' => $request->deadline,
                'workdone' => $request->workdone,
                'note' => $request->note,
            ]);
            $h_work->save();
            return response()->json([
                'status'=>1,
                'id' => $id,
                'image' => $name,
                'title' => $request->title,
                'collaborator' => $request->collaborator,
                'deadline' => $request->deadline,
                'workdone' => $request->workdone,
                'note' => $request->note,
            ]);
        }

        return response()->json(['status'=>0, 'status'=>0, 'error'=>$updateData->errors()->all()]);
        // return "kykuykyk";
        
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
            'collaborator' => 'required|max:255',
            'deadline' => 'required|max:255',
            'workdone' => 'required|numeric',
            'note' => '',
        ]);

        dd($updateData);

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

        $this->authorize('delete-work');
        $work = Work::findOrFail($id);
        $work->delete();

        return redirect('/works')->with('completed', 'work has been deleted!!!');
    }

    public function liveDelete(Request $request)
    {
        // dd($request);
        // $this->authorize('delete-work');
        $id = $request->id;
        $work = Work::findOrFail($id);
        $work->delete();

        return response()->json([
            'status' => '1',
            'msg' => 'Delete successfully!!!',
            'id' => $id,
        ]);

    }

    // Add function for search record!!!
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->get('search');
    
        // Search in the title and body columns from the posts table
        $posts = DB::table('works')
            ->where('id', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('posts'));
    }


    // Add function for livesearch record!!
    public function livesearch(Request $request){
        //$this->authorize('search');
        $inputSearch = $request['inputSearch'];
        $keyResult = DB::table('works')
            ->where('id', 'LIKE', "%{$inputSearch}%")
            ->orWhere('title', 'LIKE', "%{$inputSearch}%")
            ->get();
        echo $keyResult;
    }
    
}


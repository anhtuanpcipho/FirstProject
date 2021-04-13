<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginUser;
use App\Models\Work;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    public function getLogin()
    {
        return view('login'); //return to login page
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        //dd($email);
        //dd($password);
        //dd(Auth::attempt(array('email' => $email)));
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        // Check whether this field is selected or not

        if (Auth::attempt(array('email' => $email, 'password' => $password))) {
            // code goes here...
            //$request->session()->regenerate();

            $session = DB::table('login_users')->where('email','LIKE',"{$email}")->get();
            if(count($session)>0){
                $request->session()->put('id',$request->id);
                $request->session()->put('email',$request->email);
            }
            
            $work = Work::all();
            //return redirect()->intended('/works');
            return view('loggedin', compact('email','work'));
        } else {
        // code goes here...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
        }
    }

    public function postSignup(Request $request)
    {
        $storeData = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        $login = new LoginUser();
        $login->email = $storeData['email'];
        $login->role = $request->role;
        $login->password = bcrypt($storeData['password']);
        $login->save();
        return redirect('/works')->with('completed', 'Successfully register!');
    }

    public function signup()
    {
        return view('signup');
    }

    public function logOut(Request $rq)
    {
        $rq->session()->forget('id');
        $rq->session()->forget('email');
        return redirect('/logins');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Year;

use App\Http\Requests\DetailSubject;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        
    }

    /*public function show(Request $request)
    {
        $data = DB::select("select * from users");
        print_r($data);
    }*/


    public function create()
    {
        return view('course.create');
    }



    public function show()

    {

       $data = DB::table('users')    
       ->join('courses','courses.user_email','=','users.email')
       ->select('courses.subject_id','courses.subject_name')
       ->get()->toArray();

        
    foreach($data as $v)
    {
        $v->subject = DB::table('subject')
        ->where('subj_id','=',$v->subject_id)->get()->toArray();
    }

    echo "<pre>";
    print_r($data);

       

    }
    


}

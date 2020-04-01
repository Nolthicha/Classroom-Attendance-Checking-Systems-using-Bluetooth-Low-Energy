<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Course;

use App\Webble;



use Carbon\Carbon;

class BLEController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('courses')
      
       ->join('subject','subject.subj_id','=','courses.subject_id')
        ->select('subject.id','courses.subject_id','courses.subject_name','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room','courses.user_email')
       ->get();

       
        return view('course.ble',compact('data'));
    }
    

    public function store(Request $request)
    {

        
        /*$data=$request->all();
        //$lastid=StartStopEsp32::create($data)->type;
        if($request->tb_subject_id == null ){
            //return redirect('/course/ble')->with('status','กรุณาเลือกวิชาที่จะเริ่มเช็คชื่อ'); 
            return redirect()->back()->with('status','กรุณาเลือกวิชาที่จะเริ่มเช็คชื่อ'); 
        }*/


        if(count($request->tb_subject_id) > 0)
        {
            foreach($request->tb_subject_id as $subject=>$v){

                $data2=array(
                    'tb_subject_id'=>$request->tb_subject_id[$subject],  
                    //'type'=>$request->type,
                   
                );
                Webble::insert($data2);
            } 

            
            //return redirect()->back();
             //return redirect()->back();
        }
        else if(count($request->tb_subject_id) <= 0){
            return redirect()->back()->with('status','กรุณาเลือกวิชาที่จะเริ่มเช็คชื่อ'); 
            //return redirect('/course/ble');

        }
       
        //return redirect('/course/ble')->with('success','Data added for Subject.'); 

    }

    public function check()
    {
       
        //$course=Course::all();
                $course= DB::table('webble')
                
                ->join('subject','subject.id','=','webble.tb_subject_id')
                ->join('courses','courses.subject_id','=','subject.subj_id')
                ->select('webble.tb_subject_id','subject.day','subject.time_start','courses.user_email','courses.subject_id','courses.subject_name')
                ->whereDate('date_ble', Carbon::today())
                //->groupBy('std_id')
                ->get();


        return view('course.std_now',compact('course'));
        
    }

    
    public function std_index()
    {
        $course=Course::all();
        return view('course.std_detail',compact('course'));
        
    }

    public function std_show($subject_id)
    {
        $subject= DB::table('register_subject')
                ->where('std_subject','=' ,$subject_id)
                ->join('tb_login','tb_login.id','=','register_subject.std_id')
                ->select('register_subject.std_id','register_subject.std_subject','register_subject.year','register_subject.term','tb_login.name')
                ->groupBy('std_id')
                ->get();


        $subjectName = DB::table('courses')
                ->select('subject_id','subject_name')
                ->where('subject_id','=',$subject_id)
                ->get();

        return view('course.std_detail_show',compact('subject','subjectName'));
    }


    public function countStd($subject_id , $std_id)
    {
        $checkStd = DB::table('tb_checkback')
                ->where('subject.subj_id','=',$subject_id)
                ->where('tb_checkback.std_id','=',$std_id)
                ->join('subject','subject.id','=','tb_checkback.tb_subject')
                ->select('subject.subj_id','tb_checkback.std_id','tb_checkback.date_ble','tb_checkback.time_check')
                //->groupBy('std_id','subj_id')
                ->get();

        $countStd = count($checkStd);


        $std= DB::table('register_subject')
                ->where('std_subject','=' ,$subject_id)
                ->where('register_subject.std_id','=',$std_id)
                ->join('tb_login','tb_login.id','=','register_subject.std_id')
                ->select('register_subject.std_id','register_subject.std_subject','register_subject.year','register_subject.term','tb_login.name')
                ->get();


        $subjectName = DB::table('courses')
                ->select('subject_id','subject_name')
                ->where('subject_id','=',$subject_id)
                ->get();


        return view('course.std_detail_count',compact('countStd','std','checkStd','subjectName'));

    }

   


}
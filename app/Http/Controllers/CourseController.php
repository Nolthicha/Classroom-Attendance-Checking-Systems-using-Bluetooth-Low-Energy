<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Course;
use App\Subject;



class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $course=Course::all();
        return view('course.index',compact('course'));
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
        foreach($request->year as $subject=>$v){
            $checkSubject= DB::table('subject')
            ->select('subj_id','year','term','day','time_start')
            ->where('subj_id', '=', $request->subject_id)
            ->where('year', '=', $request->year[$subject])
            ->where('term', '=', $request->term[$subject])
            ->where('day', '=', $request->day[$subject])
            ->where('time_start', '=', $request->time_start[$subject])
            ->get()
            ->count();

        }
  
        $data=$request->all();
        

        
    if($checkSubject > 0 ){
        return redirect()->back()->with('status','ข้อมูลวิชานี้มีอยู่แล้ว');
    }
    else{ 
     
        if(count($request->year) > 0)
        {
            $lastid=Course::create($data)->subject_id;
            foreach($request->year as $subject=>$v){

                $data2=array(
                    'subj_id'=>$lastid,
                    'year'=>$request->year[$subject],
                    'term'=>$request->term[$subject],
                    'day'=>$request->day[$subject],
                    'time_start'=>$request->time_start[$subject],
                    'time_end'=>$request->time_end[$subject],
                    'room'=>$request->room[$subject]
                );
                Subject::insert($data2);

               
            }
        }

        return redirect()->back()->with('success','บันทึกข้อมูลวิชาสำเร็จ');
        
    }


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
       $subject = Subject::find($id);
        return view('course.edit', compact('subject','id'));
            //->with('subject',$subject);     
    }

    

    public function course_edit($subject_id)
    {
        // 
       $course = Course::where('subject_id', $subject_id)->firstorfail();
        return view('course.course-edit')
            ->with('course',$course);     
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


        $checkSubject= DB::table('subject')
        ->select('id','subj_id','year','term','day','time_start')
        ->where('subj_id', '=', $request->input('subj_id'))
        ->where('year', '=', $request->input('year'))
        ->where('term', '=', $request->input('term'))
        ->where('day', '=', $request->input('day'))
        ->where('time_start', '=', $request->input('time_start'))
        ->get()
        ->count();

    if($checkSubject > 0){
        //return redirect('course/subject/'.$subject->subj_id)->with('status','แก้ไขรายละเอียดวิชาสำเร็จ');
        return redirect('/course/subject-edit/'.$id)->with('status','แก้ไขไม่สำเร็จ รายละเอียดวิชานี้มีอยู่แล้ว');
    }
    else{ 
        $subject = Subject::findOrFail($id);
        $subject->year = $request->input('year');
        $subject->term = $request->input('term');
        $subject->day = $request->input('day');
        $subject->time_start = $request->input('time_start');
        $subject->time_end = $request->input('time_end');
        $subject->room = $request->input('room');
        $subject->update();


        return redirect('course/subject/'.$subject->subj_id)->with('status','แก้ไขรายละเอียดวิชาสำเร็จ');
    }
    }

    public function course_update(Request $request, $subject_id)
    {
        //
        $course = Course::where('subject_id', $subject_id)->firstorfail();
        
        $course->subject_id = $request->input('subject_id');
        $course->subject_name = $request->input('subject_name');
        
        $course->update();

        return redirect('course/index')->with('status','Data Update for Course');
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

    public function subject($subject_id)
    {
        $subject=Subject::where('subj_id','=' ,$subject_id)
        ->get();

        $subjectName = DB::table('courses')
        ->select('subject_id','subject_name')
        ->where('subject_id','=',$subject_id)
        ->get();

        $course = Course::where('subject_id', $subject_id)->firstorfail();


        return view('course.subject',compact('subject','subjectName','course'));
    }

    public function calendar(Request $request)
    { 
        $subject = DB::table('subject')
        ->groupBy('subj_id')
        ->get();

       return view('course.calendar')->with('subject',$subject);
        
    }

    public function search($subj_id,$year,$term,$day)
    {
        /*$search = $request->get('search');
        $posts = DB::table('subject')->where('year','like','%'.$search.'%')->paginate(5);
        return view('course.calendar',['posts' => $posts]);*/

        $subject= DB::table('subject')
            
                ->where('subj_id','=' ,$subj_id)
                ->orWhere('year','=' ,$year)
                ->orWhere('term','=' ,$term)
                ->orWhere('day','=' ,$day)
                
                ->get();
        return view('course.std_now_show',compact('subject'));
        
    
    }

    


    public function calendarDe($year)
    {
        $subject=Subject::where('year','=' ,$year)
        ->get();
        return view('course.calendarDe');
        
    }

    public function ble()
    {
        $data = DB::table('courses')    
       //->join('courses','courses.user_email','=','users.email')
       ->join('subject','subject.subj_id','=','courses.subject_id')
        ->select('courses.subject_id','courses.subject_name','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room','courses.user_email')
       ->get();

       
        return view('course.ble',compact('data'));
    }

    public function webcheck(Request $request)
    {

        $subject = new Subject;
        $subject->subj_id = $request->input('subj_id');
        $subject->year = $request->input('year');
        $subject->term = $request->input('term');
        $subject->day = $request->input('day');
        $subject->time_start = $request->input('time_start');
        $subject->time_end = $request->input('time_end');
        $subject->room = $request->input('room');

        $subject->save();


        return redirect('/course/index')->with('success','Data added for Subject.'); 
        

    }

    

    public function std_back()
    {
      
        return view('course.std_back');
    }

    public function savepage($subject_id)
    {
        $subject = DB::table('subject')
                    ->select('subj_id')
                    //->where('subj_id','=',$subject_id)
                    ->groupBy('subj_id')
                    ->get();

        $course = Course::where('subject_id', $subject_id)->firstorfail();
         

        return view('course.save-sub',compact('subject','course'));//->with('subject',$subject);
    }

    public function savelist(Request $request)
    {


        
            $checkSubject= DB::table('subject')
            ->select('subj_id','year','term','day','time_start')
            ->where('subj_id', '=', $request->input('subj_id'))
            ->where('year', '=', $request->input('year'))
            ->where('term', '=', $request->input('term'))
            ->where('day', '=', $request->input('day'))
            ->where('time_start', '=', $request->input('time_start'))
            ->get()
            ->count();


        if($checkSubject > 0 ){
            return redirect('/course/savepage/'.$request->input('subj_id'))->with('status','รายละเอียดวิชานี้มีอยู่แล้ว');
        }
        else{ 
        $subject = new Subject;
        $subject->subj_id = $request->input('subj_id');
        $subject->year = $request->input('year');
        $subject->term = $request->input('term');
        $subject->day = $request->input('day');
        $subject->time_start = $request->input('time_start');
        $subject->time_end = $request->input('time_end');
        $subject->room = $request->input('room');

        $subject->save();


        return redirect('/course/subject/'.$request->input('subj_id'))->with('status','เพิ่มรายละเอียดวิชาสำเร็จ'); 

        }
    }



}

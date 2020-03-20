<?php

namespace App\Http\Controllers\Admin;

use App\Subject;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageSubjectController extends Controller
{
    //
    public function index()
    {
        /*$subject = DB::table('courses')    
       //->join('courses','courses.user_email','=','users.email')
       ->join('subject','subject.subj_id','=','courses.subject_id')
        ->select('courses.subject_id','courses.subject_name','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room','courses.user_email')
       ->get();
        
       return view('admin.manage-subject',compact('subject'));*/
        
        $subject = Course::all();

        return view("admin.manage-subject")
            ->with('subject',$subject);
    }
    public function store(Request $request)
    {
        
        return view("admin.manage-subject");
    }

    public function edit($id)
    {
       $subject = Course::where('subject_id', $id)->firstorfail();
        return view('admin.subject.edit')
            ->with('subject',$subject);
            
    }

    public function update(Request $request, $id)
    {
        $subject = Course::where('subject_id', $id)->firstorfail();
        $subject->subject_id = $request->input('subject_id');
        $subject->subject_name = $request->input('subject_name');
        
        $subject->update();

        return redirect('manage-subject')->with('status','Data Update for Subject');

    }

    public function delete($id)
    {

        /*$subject = DB::table('courses')    
       //->join('courses','courses.user_email','=','users.email')
       ->join('subject','subject.subj_id','=','courses.subject_id')
        //->select('subject.subj_id','courses.subject_id','courses.subject_name','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room','courses.user_email')
        ->select('subject.subj_id','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room')
        ->delete();*/

        



        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect('manage-subject')->with('status','Data Delete for Subject');
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Course;


class SearchController extends Controller
{
  //
  function index()
  {


    return view('course.calendar'); //,compact('data')
  }

  function action(Request $request)
  {


    if ($request->ajax()) {

      $output = '';
      $query = $request->get('query');
      if ($query != '') {
        $data = DB::table('courses')
          ->join('subject', 'subject.subj_id', '=', 'courses.subject_id')
          ->where('subject.subj_id', 'like', '%' . $query . '%')
          ->orWhere('courses.subject_name', 'like', '%' . $query . '%')
          ->orWhere('subject.year', 'like', '%' . $query . '%')
          ->orWhere('subject.term', 'like', '%' . $query . '%')
          ->orWhere('subject.day', 'like', '%' . $query . '%')
          ->orWhere('subject.time_start', 'like', '%' . $query . '%')
          ->orWhere('subject.time_end', 'like', '%' . $query . '%')
          ->orWhere('subject.room', 'like', '%' . $query . '%')




          ->orderBy('id', 'desc')
          ->get();
      } else {
        $data = DB::table('subject')
          ->join('courses', 'courses.subject_id', '=', 'subject.subj_id')
          //->select('subject.id','courses.subject_id','courses.subject_name','subject.year','subject.term','subject.day','subject.time_start','subject.time_end','subject.room','courses.user_email')
          ->select('courses.subject_name', 'courses.user_email', 'courses.subject_id', 'subject.year', 'subject.term', 'subject.day', 'subject.time_start', 'subject.time_end', 'subject.room')
          //->orderBy('id', 'desc')
          ->get();
      }
      $total_row = $data->count();
      $user = Auth::user()->email;
      if ($total_row > 0) {
        foreach ($data as $row) {
          if ($user == $row->user_email) {
            $output .= '
        <tr>
         <td>' . $row->subject_id . '</td>
         <td>' . $row->subject_name . '</td>
         <td>' . $row->year . '</td>
         <td>' . $row->term . '</td>
         <td>' . $row->day . '</td>
         <td>' . $row->time_start . '</td>
         <td>' . $row->time_end . '</td>
         <td>' . $row->room . '</td>
         
        
        </tr>
        ';
          }
        }
      } else {
        $output = '
       <tr>
        <td align="center" colspan="5">ไม่พบข้อมูล</td>
       </tr>
       ';
      }
      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
      );

      echo json_encode($data);
    }
  }

  function date_index()
  {
    return view('course.std_back');
  }



  function fetch_data(Request $request)
  {

    $user = Auth::user()->email;
    if ($request->ajax()) {
      if ($request->from_date != '' && $request->to_date != '') {

        $data = DB::table('tb_checkstd')

          ->join('courses', 'courses.subject_id', '=', 'tb_checkstd.std_subject')

          //->select('courses.user_email','courses.subject_id','tb_check.std_id','std_day')
          ->whereBetween('date_ble', array($request->from_date, $request->to_date))
          ->groupBy('std_id')
          ->get();
      } else {


        $data = DB::table('tb_checkstd')
          ->join('courses', 'courses.subject_id', '=', 'tb_checkstd.std_subject')
          //->select('courses.user_email','courses.subject_id','tb_check.std_id','std_day')

          ->orderBy('date_ble', 'desc')
          ->groupBy('std_id')
          ->get();
      }
      echo json_encode($data);
    }
  }

  public function compareTime(Request $request, $subject_id)
  {


    $date = DB::table('webble')
      //->where('std_subject','=' ,$subject_id)
      ->select('created_at')
      ->whereDate('date_ble', Carbon::today())
      ->whereRaw('id IN (select MAX(id) FROM webble)')
      //->groupBy('std_id')
      //->get();
      ->pluck('created_at');
    //return view('course.test',compact('subject'));


    //$date = '2020-03-07 14:00:00';
    $last = DB::table('tb_checkstd')
      ->where('tb_subject', '=', $subject_id)
      ->join('tb_login', 'tb_login.id', '=', 'tb_checkstd.std_id')
      ->select('tb_checkstd.std_id', 'tb_login.name', 'tb_checkstd.time')
      ->whereRaw('tb_checkstd.id IN (select MAX(tb_checkstd.id) FROM tb_checkstd GROUP BY std_id)')
      //->count('tb_checkstd.id IN (select MAX(tb_checkstd.id) FROM tb_checkstd GROUP BY std_id)')
      ->get();



    $subject = DB::table('tb_checkstd')
      ->where('tb_subject', '=', $subject_id)
      ->join('tb_login', 'tb_login.id', '=', 'tb_checkstd.std_id')
      ->select('tb_checkstd.std_id', 'tb_login.name', 'tb_checkstd.time')
      ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, tb_checkstd.created_at, ?)) <= 180', [$date])
      //->exists();
      ->groupBy('std_id')

      ->get();




    $countBack = DB::table('tb_checkstd')
      ->where('tb_subject', '=', $subject_id)
      ->join('tb_login', 'tb_login.id', '=', 'tb_checkstd.std_id')
      ->select('tb_checkstd.std_id', 'tb_login.name', 'tb_checkstd.time')
      ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, tb_checkstd.created_at, ?)) <= 150', [$date])
      //->exists();
      //->groupBy('std_id')
      ->get();

    $countStd = count($subject);


    $subjectName = DB::table('courses')
      ->join('subject', 'subject.subj_id', '=', 'courses.subject_id')
      ->select('courses.subject_id', 'courses.subject_name')
      ->where('subject.id', '=', $subject_id)
      ->get();


    return view('course.std_now_show', compact('subject', 'subjectName', 'last'))->with('countStd', $countStd);

    //return view('course.std_now_show',compact('subject'),compact('subjectName'),compact('last'))->with('countStd', $countStd);


  }


  public function subBack()
  {

    $course = DB::table('courses')
      ->join('subject', 'subject.subj_id', '=', 'courses.subject_id')
      ->select('subject.id', 'subject.day', 'subject.time_end', 'subject.time_start', 'courses.subject_id', 'courses.subject_name', 'courses.user_email')
      ->get();

    return view('course.std_back_sub', compact('course'));
  }



  public function indexBack(Request $request, $subject_id)
  {

    $std = DB::table('tb_checkback')
      ->join('tb_login', 'tb_login.id', '=', 'tb_checkback.std_id')
      //->join('subject','subject.id','=','tb_checkback.tb_subject')
      //->join('courses','courses.subject_id','=','tb_checkback.std_subject')
      ->select('tb_checkback.tb_subject', 'tb_checkback.std_id', 'tb_login.name', 'tb_checkback.date_ble')

      ->where('tb_subject', '=', $subject_id)
      ->groupBy('date_ble')
      ->get();


    $subjectName = DB::table('courses')
      ->join('subject', 'subject.subj_id', '=', 'courses.subject_id')
      ->select('courses.subject_id', 'courses.subject_name')
      ->where('subject.id', '=', $subject_id)
      ->get();


    return view('course.std_back', compact('std'), compact('subjectName'));
  }



  public function dateBack($subject_id, $date)
  {

    $std = DB::table('tb_checkback')
      //->select('std_id')
      ->join('tb_login', 'tb_login.id', '=', 'tb_checkback.std_id')
      ->join('subject', 'subject.id', '=', 'tb_checkback.tb_subject')
      ->select('tb_login.name', 'subject.subj_id', 'tb_checkback.tb_subject', 'tb_checkback.std_id', 'tb_checkback.date_ble', 'tb_checkback.time_check')

      ->where([['date_ble', '=', $date], ['tb_subject', '=', $subject_id]])
      //->groupBy('std_id')
      ->get();


    $subjectName = DB::table('courses')
      ->join('subject', 'subject.subj_id', '=', 'courses.subject_id')
      ->select('courses.subject_id', 'courses.subject_name', 'subject.time_start', 'subject.time_end')
      ->where([['subject.id', '=', $subject_id]])
      ->get();


    $countBack = count($std);





    return view('course.std_back_show', compact('std', 'subjectName', 'countBack'));
  }
}

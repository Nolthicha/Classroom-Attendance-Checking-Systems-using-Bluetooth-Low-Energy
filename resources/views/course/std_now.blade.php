@extends('template.master')

@section('content')

<div class="container">
<div class="card">
                <div class="card-header">

                <h3 class="card-title"> รายละเอียดผู้เข้าเรียนวันนี้</h3>
               

                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      
                      
                      <th>รหัสวิชา</th>
                      <th>ชื่อวิชา</th>
                      <th>วัน</th>
                      <th>เวลาเริ่มสอน</th>
                      

                     
                      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($course as $key => $subject)
                  @if(auth()->user()->email == $subject->user_email)
                    <tr>
                    <td><a href="{{ route('std_now_show.course',$subject->tb_subject_id) }}">{{ $subject->subject_id }}</a></td>
                      <td> {{ $subject->subject_name }} </td> 
                      <td> {{ $subject->day }} </td>
                      <td> {{ $subject->time_start }} </td>         
                    </tr>
                    @endif
                @endforeach
                  </tbody>
                </table>
             
                <div class="row">
            </div>
        </div>
    </div>
</div>
            
            
@endsection


@extends('template.master')

@section('content')

<div class="container">
<div class="card">
                <div class="card-header">

                <h3 class="card-title">รายชื่อนักศึกษาและจำนวนครั้งที่เข้าเรียนในแต่ละรายวิชา</h3>
               

                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      
                      
                      <th>รหัสวิชา</th>
                      <th>ชื่อวิชา</th>
                     
                      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($course as $key => $subject)
                  @if(auth()->user()->email == $subject->user_email)
                    <tr>
                    <td><a href="{{ route('std.course',$subject->subject_id) }}">{{ $subject->subject_id }}</a></td>
                      <td> {{ $subject->subject_name }} </td>         
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


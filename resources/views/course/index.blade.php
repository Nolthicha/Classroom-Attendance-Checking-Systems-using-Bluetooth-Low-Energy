@extends('template.master')

@section('content')

<div class="container">
<div class="card">
                <div class="card-header">
                <form action=" {{ url('#') }}" method="POST">



                <h3 class="card-title"> รายชื่อวิชา  | <a href="{{ url('course/calendar') }}"> ค้นหารายละเอียดวิชา </a></h3>
               
                <a href="{{ url('course/create') }}" class="btn btn-primary btn-lg">เพิ่มวิชาที่สอน >></a>
                </div>


                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                    <td><a href="{{ route('subject.course',$subject->subject_id) }}">{{ $subject->subject_id }}</a></td>
                      <td> {{ $subject->subject_name }} </td>  
                      <!--<td>
                           <a href="{{ url('course/course-edit/'.$subject->subject_id) }}" class="btn btn-success">แก้ไข</a>
                        </td> -->      
                    </tr>
                    @endif
                @endforeach
                  </tbody>
                </table>
             
             </form>
                <div class="row">
            </div>
        </div>
    </div>
</div>
            
            
@endsection


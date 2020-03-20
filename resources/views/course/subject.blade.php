@extends('template.master')

@section('content')


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('save.course') }}" method="POST">
            {{ csrf_field() }}

      <div class="modal-body">
       


      </div>
     
      </form>
    </div>
  </div>
</div>



<div class="container">
    
<div class="card">
                <div class="card-header">
                <h3 class="card-title">รายละเอียดวิชา</h3>

                @foreach($subjectName as $name)
                วิชา {{ $name->subject_id }}
                {{ $name->subject_name }}
                @endforeach
                <div>
                </div>

                <a href="{{ url('course/savepage/'.$course->subject_id) }}" class="btn btn-primary btn-lg">เพิ่ม</a>
                
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
                                   
                      
                      
                      <th>ปีการศึกษา</th>
                      <th>ภาคการศึกษา</th>
                      <th>วันการสอน</th>
                      <th>เวลาเริ่มสอน</th>
                      <th>เวลาสิ้นสุด</th>
                      <th>ห้องเรียน</th>
                      <th></th>
                      

                    </tr>
                  </thead>
                  <tbody>
                  @foreach($subject as $subject)
                  
                    <tr>
   
                    
                      <td> {{ $subject->year }} </td>
                      <td> {{ $subject->term }} </td>
                      <td> {{ $subject->day }} </td>
                      <td> {{ $subject->time_start }} </td>
                      <td> {{ $subject->time_end }} </td>
                      <td> {{ $subject->room }} </td>
                      <td>
                           <a href="{{ url('course/subject-edit/'.$subject->id) }}" class="btn btn-success">แก้ไข</a>
                        </td>
                      
                      
                    </tr>
                 
                @endforeach
                  </tbody>
                </table>
              
            </div>
        </div>
    </div>
</div>
                 
@endsection


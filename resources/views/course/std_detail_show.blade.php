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
      <form action="{{ url('#') }}" method="POST">
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
                <h3 class="card-title">รายชื่อนักศึกษาและจำนวนครั้งที่เข้าเรียนในแต่ละรายวิชา</h3>
                เลือกที่รหัสนักศึกษาเพื่อดูจำนวนครั้งที่เข้าเรียน
                <p></p>
                @foreach($subjectName as $name)
                วิชา {{ $name->subject_id }}
                {{ $name->subject_name }}
                @endforeach
                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                                   
                      <th>รหัสนักศึกษา</th>
                      <th>ชื่อนักศึกษา</th>
                      <th>ปีการศึกษา</th>
                      <th>เทอม</th>
                    
                      


                    </tr>
                  </thead>
                  <tbody>
                  @foreach($subject as $subject)
                  
                    <tr>
                    <td><a href="{{ url('course/std_detail/'.$subject->std_subject.'/'.$subject->std_id) }}"> {{ $subject->std_id }} </a></td>
                    <td> {{ $subject->name }} </td>
                    <td> {{ $subject->year }} </td>
                    <td> {{ $subject->term }} </td>


                    <td>
                   
                    
                    
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


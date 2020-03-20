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
                <h3 class="card-title">นักศึกษาที่เข้าเรียน </h3>
                
                <div>
                @foreach($subjectName as $name)
                วิชา {{ $name->subject_id }}
                {{ $name->subject_name }}
                @endforeach

                </div>


                วันที่ {{ formatDateThai( date("Y-m-d")) }}
                <div>
                มีนักศึกษาเข้าเรียนทั้งหมด {{$countStd}} คน
                </div>
                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                                   
                    <th>รหัสนักศึกษา</th>
                      <th>ชื่อนักศึกษา</th>
                      <th>เวลาเริ่มเข้าเรียน</th>
                      <th>เวลาล่าสุด</th>

                    </tr>
                  </thead>
                  <tbody>
                 
                  @foreach($subject as $subject)
                  
                    <tr>
                    <td> {{ $subject->std_id }} </td>
                    <td> {{ $subject->name }} </td>
                    <td> {{ $subject->time }} </td>
                    <td>
                    @foreach($last as $std)
                        @if($std->std_id === $subject->std_id)
                            {{ $std->time }}
                        @endif
                    @endforeach
                    
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


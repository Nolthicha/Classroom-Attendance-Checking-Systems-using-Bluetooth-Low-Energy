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
                <h3 class="card-title">รายชื่อนักศึกษา (รายละเอียดการเข้าเรียนย้อนหลัง)</h3>

                @foreach($subjectName as $name)
                วิชา {{ $name->subject_id }}
                {{ $name->subject_name }}
                <p>
                ช่วงเวลา {{ $name->time_start }} - {{ $name->time_end }}
                </p>
                @endforeach

                มีนักศึกษาเข้าเรียนทั้งหมด {{ $countBack }} คน

                
                
                
                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                                   
                      <th>รหัสนักศึกษา</th>
                      <th>ชื่อ</th>
                      <th>วัน</th>
                    <th>เวลาเข้าเรียน</th>
                      


                    </tr>
                  </thead>
                  <tbody>
                 

                  @foreach($std as $std)
                  
                    <tr>

                    <td> {{ $std->std_id }} </td>
                    <td> {{ $std->name }} </td>
                    <td> {{ $std->date_ble }} </td>
                    <td> {{ $std->time_check }} </td>
                  
                    </tr>

                 
                @endforeach

               
              

                
                  </tbody>
                </table>
              
            </div>
        </div>
    </div>
</div>
                 
@endsection


@extends('template.master')

@section('content')

<div class="container">
<div class="card">
                <div class="card-header">

                <h3 class="card-title">จำนวนการเข้าเรียน</h3>




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
                      <th>ชื่อ</th>
                      <th>จำนวนครั้งที่เข้าเรียนวิชานี้</th>
                     
                     
                      
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($std as $name)
                 <td>{{ $name->std_id }}</td>
                <td>{{ $name->name }}</td>

                
                @endforeach 
               
                   
                  <td>{{ $countStd }}  ครั้ง</td>
                 

                  </tbody>
                </table>
             
                
            </div>


            <div class="card-footer">
            <div class="card-body p-">
            <table class="table">
                  <thead>
                  <tr>
            <th>วันที่เข้าเรียน</th>
            <th>เวลาที่เข้าเรียน</th>
            </tr>
                      </thead>
            </div>
            
            <tbody>
            @foreach($checkStd as $check)
           <tr>             
            <td>{{ $check->date_ble }}</td>
            <td>{{ $check->time_check }}</td>
                        </tr>
                @endforeach
                </tbody>




            </div>

        </div>

        
    </div>
</div>
            
            
@endsection


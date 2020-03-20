@extends('template.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">


    
        <div class="col-md-12">
            <div class="card">
            

                <div class="card-header">
                <h3 class="card-title">ระบบเช็คชื่อและตรวจสอบการเข้าเรียนในชั้นเรียน โดยใช้บลูทูธพลังงานต่ำ</h3></div>



                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div>
                  
                    <!--<a href="{{ url('course/create') }}" class="btn btn-primary btn-lg">เพิ่มวิชาที่สอน >></a>-->
                   
                    
                    
                   
                    
                    <!--<a href="{{ url('course/index') }}" class="btn btn-primary btn-lg">วิชาทั้งหมด >></a>-->
                  
                    </div>
                    <div>
                    <br>
                    <br>
                    <a href="{{ url('course/ble') }}" class="btn btn-primary btn-lg">เลือกวิชาเพื่อเริ่มเช็คชื่อ</a>
                   </br>
                   </br>
                   </div>


                   <div>
                   <br>
                   <!--<a href="{{ url('course/std_detail') }}" class="btn btn-primary btn-lg">รายชื่อนักเรียนในแต่ละรายวิชา >></a>-->
                   </br>
                    <br>
                    <br>
                    <!--<a href="{{ url('course/std_now') }}" class="btn btn-primary btn-lg">รายละเอียดนักเรียนที่เข้าเรียนวันนี้ >></a>
                    <a href="{{ url('course/std_back_sub') }}" class="btn btn-primary btn-lg">รายละเอียดย้อนหลังการเข้าเรียน >></a>-->
                   
                   
                   </br>
                   </br>
                   </div>


                </div>
               
            </div>
            
        </div>
    </div>
</div>



            </div>
        </div>
    </div>
</div>
@endsection

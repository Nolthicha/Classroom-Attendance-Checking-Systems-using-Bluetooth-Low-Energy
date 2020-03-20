
@extends('template.master')

@section('content')

<script src="https://cdn.netpie.io/microgear.js"></script>

<script>

  const APPID = "tahewkaw";
  const KEY = "WKNyyjMOpphlDgU";
  const SECRET = "GObXnTHztwfMusuTw2viMhs8R";

  const ALIAS = "W_token";     //  ชื่อตัวเอง
  const thing1 = "A_token";    //  ชื่อเพื่อนที่จะคุย

  function switchPress(logic){
    if(logic == 1 ){
      microgear.chat(thing1,"ON");
    }else if(logic == 0 ){
      microgear.chat(thing1,"OFF");
    }
  }

  var microgear = Microgear.create({
    key: KEY,
    secret: SECRET,
    alias : ALIAS
  });

  var tem = 2;

  microgear.on('message', function(topic,data) {
    
    if(data=="ON" || tem==1){
      tem = 1;
        if(tem==1){
          document.getElementById("Status").innerHTML =  "สถานะของการเช็คชื่อ : Start Class";
        }

    }else if(data=="OFF"){
      tem = 0;
      document.getElementById("Status").innerHTML =  "สถานะของการเช็คชื่อ : Stop Class"; 
    }



  });

  microgear.on('connected', function() {
    microgear.setAlias(ALIAS);
    document.getElementById("connected_NETPIE").innerHTML = "";
    
  });

  microgear.on('present', function(event) {
    console.log(event);
  });

  microgear.on('absent', function(event) {
    console.log(event);
  });

  microgear.resettoken(function(err) {
    microgear.connect(APPID);
  });



</script>


<script>

$(document).ready(function() {            
            $("#btn").click(function() {
                        
                    var formData = $('#store').serialize();
 
                    $.ajax({
                        type: "POST",              // method : POST
                        url: '/course/attendance',       // action : register.php
                        data: formData,

						beforeSend: function() {
							//$("#result").text("Please wait..");
						},
                        
                        success: function (res) {
                            //$("#result").html(res);                         
                        },
                        error: function (e) {
                            //$("#result").text("Failed to save");
                        }
                    });
            });
        });

    </script>







<div class="container">
<div class="card">
<!--{{ route('storeAtt.course') }}-->
<form id="store" action="" method="POST">
{{ csrf_field() }}
            <!--<input type="hidden" value="{{ csrf_token() }}" id="token"/>-->

                <div class="card-header">

                <h3 class="card-title">เลือกวิชาที่จะเริ่มเช็คชื่อ</h3>  {{ date("d/m/Y H:i:s")}}

                <blockquote class="blockquote text-right">
  <!--<p class="mb-0">สถานนะการเช็คชื่อ : เปิด-ปิด</p>-->
  
</blockquote>
              

                </div>

                @if (session('status'))
                        <div class="alert alert-danger" role="alert">
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
                      <th>ปีการศึกษา</th>
                      <th>ภาคการศึกษา</th>
                      <th>วันการสอน</th>
                      <th>เวลาเริ่มสอน</th>
                      <th>เวลาสิ้นสุด</th>
                      <th>ห้องเรียน</th>
                      <th>BLE</th>

                    </tr>
                  </thead>
                  <tbody>

                 
                  @foreach($data as $key => $subject)
                  @if(auth()->user()->email == $subject->user_email)
                
                    <tr>
                    

                      <td> {{ $subject->subject_id }} </td>
                      <td> {{ $subject->subject_name }} </td>
                      <td> {{ $subject->year }} </td>
                      <td> {{ $subject->term }} </td>
                      <td> {{ $subject->day }} </td>
                      <td> {{ $subject->time_start }} </td>
                      <td> {{ $subject->time_end }} </td>
                      <td> {{ $subject->room }} </td>

                      <td><div class="form-check form-check-inline">
                      <input name="tb_subject_id[]" class="form-check-input" value="{{ $subject->id }}" type="checkbox" id="tb_subject_id">
                    
                      </div></td>

                    <tr>
                                  
                    @endif
                @endforeach

                  </tbody>
                </table>
                <center>
  <h1 id="connected_NETPIE"></h1>
  <button type="button" id="btn" onclick="switchPress(1)" class="btn btn-primary">Start Class</button>
  
      <div><p><a href="{{ route('std_now.course') }}" class="float-right" target="_blank">ดูรายชื่อนักศึกษาที่เข้าเรียน</a> </div>

 </center>
                    
          </div>
          
        </div>
        <div id="result" class="mt-2"></div>
        </form>
       
<center>

        <button class="btn btn-danger" onclick="switchPress(0)">Stop Class</button>
        
  <p><strong id="Status">สถานะของการเช็คชื่อ : Stop Class</strong></p>
  </center>
        
</div>
  
@endsection


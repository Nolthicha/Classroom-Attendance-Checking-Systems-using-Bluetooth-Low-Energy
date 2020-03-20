



<!DOCTYPE html>


<!--<html>-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>เพิ่มวิชา</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Classroom Attendance') }}</title>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">

</head>






<body>

<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    หน้าหลัก
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    
      <li class="nav-item">
        <a class="nav-link" href="{{ url('course/index') }}">วิชาทั้งหมด</a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ข้อมูลการเข้าเรียนทั้งหมด
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('course/std_now') }}">ดูนักศึกษาที่เข้าเรียนวันนี้</a>
          <a class="dropdown-item" href="{{ url('course/std_back_sub') }}">ดูการเข้าเรียนย้อนหลัง</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ url('course/std_detail') }}">รายชื่อนักศึกษาและจำนวนครั้งที่เข้าเรียนในแต่ละรายวิชา</a>
        </div>
      </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

            
        </main>
    </div>
    



<div class="container">

</div><br>
@if(Session::has('success'))
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif

@if(Session::has('status'))
<div class="alert alert-danger">
    {{Session::get('status')}}
</div>
@endif


    <form role="form"  method="post" action="{{ route('create.course') }}">
        {{csrf_field()}}
        <section>
            <div class="panel panel-header">
                <div class="row">
                    <div class="col-md-2">
                <div class="from-group">
                    <input type="text" name="subject_id" class="from-control" placeholder="รหัสวิชา">
                
                </div></div>
                <div class="col-md-2">
                <div class="from-group">
                    <input type="text" name="subject_name" class="from-control" placeholder="ชื่อวิชา">
                </div></div>


            </div></div>
            <div class="panel panel-footer">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th>ปีการศึกษา</th>
                            <th>ภาคการศึกษา</th>
                            <th>วันในการสอน</th>
                            <th>เวลาเริ่มสอน</th>
                            <th>เวลาสิ้นสุด</th>
                            <th>ห้องเรียน</th>
                            <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="hidden" name="user_email" value="{{ Auth::user()->email }}"> 

                            

                            <td><select input name="year[]" id="selectYear" style="width:auto;" class="form-control selectWidth" required="">
                            @for ($i = 2562; $i <= 2580; $i++)
                            <option value="{{$i}}" class="">{{$i}}</option>
                            @endfor
                        </select></td>



                            <td><select input name="term[]" id="term"  required="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>  
                                </select></td>
                        
                            
                            <td><select input name="day[]" id="day"  required="">
                                    <option value="จันทร์">จันทร์</option>
                                    <option value="อังคาร">อังคาร</option>
                                    <option value="พุธ">พุธ</option>
                                    <option value="พฤหัสบดี">พฤหัสบดี</option>
                                    <option value="ศุกร์">ศุกร์</option>
                                    <option value="เสาร์">เสาร์</option>
                                    <option value="อาทิตย์">อาทิตย์</option>  

                                </select></td>


                            <td><select input name="time_start[]" id="time_start"  required="">
                            <option>08:30</option>
                            <option>09:25</option>
                            <option>10:20</option>
                            <option>11:15</option>
                            <option>12:10</option>
                            <option>13:00</option>
                            <option>13:55</option>
                            <option>14:50</option>
                            <option>15:45</option>
                            <option>16:40</option>
                            <option>17:35</option> 

                            </select></td>


                            <td><select input name="time_end[]" id="time_end"  required="">
                            <option>09:20</option>
                            <option>10:15</option>
                            <option>11:10</option>
                            <option>12:05</option>
                            <option>12:10</option>
                            <option>12:55</option>
                            <option>13:50</option>
                            <option>14:45</option>
                            <option>15:40</option>
                            <option>16:35</option>
                            <option>17:30</option>
                            <option>18:55</option>  

                                </select></td>

                            
                            <td><select input name="room[]" id="room"  required="">
                                    <option value="1641">1641</option>
                                    <option value="1640">1640</option>
                                   
                                </select></td>

                            <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td><input type="submit" name="" value="Submit" class="btn btn-success"></td>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </section>
    </from>
</div>



<script type="text/javascript">





    
    
    
    //console.log(duplicate_count);
   

    $('.addRow').on('click',function(){
        addRow();   
    });



    
    
    function addRow()
    {
        var tr='<tr>'+
        '<td><select input name="year[]" id="selectYear" style="width:auto;" class="form-control selectWidth" required="">'+
                            '@for ($i = 2562; $i <= 2580; $i++)'+
                            '<option value="{{$i}}" class="">{{$i}}</option>'+
                            '@endfor'+
                        '</select></td>'+

        '<td><select input name="term[]" id="cars"  required="">'+
                                    '<option value="1">1</option>'+
                                    '<option value="2">2</option>'+
                                    '<option value="3">3</option>'+
                                    
                                '</select></td>'+
        '<td><select input name="day[]" id="day"  required="">'+
                                    '<option value="จันทร์">จันทร์</option>'+
                                    '<option value="อังคาร">อังคาร</option>'+
                                    '<option value="พุธ">พุธ</option>'+
                                    '<option value="พฤหัสบดี">พฤหัสบดี</option>'+
                                    '<option value="ศุกร์">ศุกร์</option>'+
                                    '<option value="เสาร์">เสาร์</option>'+
                                    '<option value="อาทิตย์">อาทิตย์</option>'+  

                                '</select></td>'+

        '<td><select input name="time_start[]" id="time_start"  required="">'+
                            '<option>08:30</option>'+
                            '<option>09:25</option>'+
                            '<option>10:20</option>'+
                            '<option>11:15</option>'+
                            '<option>12:10</option>'+
                            '<option>13:00</option>'+
                            '<option>13:55</option>'+
                            '<option>14:50</option>'+
                            '<option>15:45</option>'+
                            '<option>16:40</option>'+
                            '<option>17:35</option>'+

                            '</select></td>'+


        '<td><select input name="time_end[]" id="time_end"  required="">'+
                            '<option>09:20</option>'+
                            '<option>10:15</option>'+
                            '<option>11:10</option>'+
                            '<option>12:05</option>'+
                            '<option>12:10</option>'+
                            '<option>12:55</option>'+
                            '<option>13:50</option>'+
                            '<option>14:45</option>'+
                            '<option>15:40</option>'+
                            '<option>16:35</option>'+
                            '<option>17:30</option>'+
                            '<option>18:55</option>'+ 

                            '</select></td>'+
        '<td><select input name="room[]" id="room"  required="">'+
                                    '<option value="1641">1641</option>'+
                                    '<option value="1640">1640</option>'+
                                   
                                '</select></td>'+
        '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>'+
        
        
        '</tr>';

        $('tbody').append(tr);
    };






        $('.remove').live('click',function(){
        var last=$('tbody tr').length;
        if(last==1){
            alert("You can not remove last row");
        }
        else{
            $(this).parent().parent().remove();
        }
        
    });
</script>


</body>



</html>




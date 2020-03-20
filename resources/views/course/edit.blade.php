@extends('template.master')


@section('title')
    Manage Subjects Edit
@endsection

@section('content')

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>แก้ไขรายละเอียดวิชา</h3>
                
                    <form action=" {{ url('course/subject-update/'.$subject->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}

                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="modal-body">

                    <div class="form-group">
           
           
            <!--<input name="id" value="{{ $subject->id }}" type="hidden">-->
         

          </div>

       
                    <div class="form-group">
            <label for="recipient-name" class="col-form-label">รหัสวิชา</label>
            <input name="subj_id" value="{{ $subject->subj_id }}" type="hidden">

            {{ $subject->subj_id }}
          </div>

            <div class="form-group">
            <label for="recipient-name" class="col-form-label">ปีการศึกษา</label>
            
            <select name="year" value="{{ $subject->year }}" class="form-control">
            @for ($i = 2562; $i <= 2580; $i++)
                            <option value="{{$i}}" class="">{{$i}}</option>
            @endfor
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ภาคการศึกษา</label>
            <select name="term" value="{{ $subject->term }}" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>

            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">วันที่สอน</label>
            <select name="day" value="{{ $subject->day }}" class="form-control">
                                    <option value="จันทร์">จันทร์</option>
                                    <option value="อังคาร">อังคาร</option>
                                    <option value="พุธ">พุธ</option>
                                    <option value="พฤหัสบดี">พฤหัสบดี</option>
                                    <option value="ศุกร์">ศุกร์</option>
                                    <option value="เสาร์">เสาร์</option>
                                    <option value="อาทิตย์">อาทิตย์</option>  
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">เวลาเริ่มสอน</label>
            <select name="time_start" value="{{ $subject->time_start }}" class="form-control">
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
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">เวลาสิ้นสุด</label>
            <select name="time_end" value="{{ $subject->time_end }}" class="form-control">
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
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ห้อง</label>
            <select name="room" value="{{ $subject->room }}" class="form-control">
                            <option value="1641">1641</option>
                            <option value="1640">1640</option>
            </select>
          </div>

                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/course/index') }}" class="btn btn-secondary">กลับ</a>
                        <button type="submit" class="btn btn-primary">อัพเดท</button>
                    </div>
                    </form>
                
                
                
                
                </div>
            </div>
        </div>
</div>





@endsection

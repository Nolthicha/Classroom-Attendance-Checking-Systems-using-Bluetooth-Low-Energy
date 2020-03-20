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
                
                    <form action=" {{ url('course/course-update/'.$course->subject_id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}

                    <div class="modal-body">
       
                    <div class="form-group">
            <label for="recipient-name" class="col-form-label">รหัสวิชา</label>
            <input name="subject_id" value="{{ $course->subject_id }}" class="form-control" type="text" placeholder="">
            
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ชื่อวิชา</label>
            <input name="subject_name" value="{{ $course->subject_name }}" class="form-control" type="text" placeholder="">
            
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

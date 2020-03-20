@extends('layouts.template')


@section('title')
    Edit- Registered
@endsection



@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>แก้ไขรายละเอียด</h3>
                </div>

                <div class="card-body">
                   <div class="row">
                        <div class="col-md-6">
                        <form action="/role-register-update/{{ $users->id }}" method="POST">  
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" name="username" value="{{ $users->name}}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input type="text" name="email" value="{{ $users->email}}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>สถานะ</label>
                        <select name="usertype" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                        <button type="submit" class="btn btn-success"> อัพเดท </button>
                        <a href="/role-register" class="btn btn-danger"> ยกเลิก </a>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection

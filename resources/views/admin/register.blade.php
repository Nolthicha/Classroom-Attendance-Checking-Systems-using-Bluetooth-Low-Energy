@extends('layouts.template')


@section('title')
    Register Roles
@endsection



@section('content')

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> ผู้ใช้งานระบบ</h4>

                <a href="{{ url('/register') }}" class="btn btn-primary float-right">เพิ่ม</a>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              </div>
                        
              <div class="card-body">
                <div class="table-responsive">
                <td>
                         
                        </td>
                  <table class="table">
                    <thead class=" text-primary">
                      <th>ชื่อ</th>
                      <th>อีเมล์</th>
                      <th>สถานะ</th>
                      <th>แก้ไข</th>
                      
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                      <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email}}</td>
                        <td>-{{ $row->userType}}</td>
                        <td>
                           <a href="/role-edit/{{ $row->id }}" class="btn btn-success">แก้ไข</a>
                        </td>
                        <td>
                            <form action="/role-delete/{{ $row->id }}" method="post">
                                {{ csrf_field()}}
                                {{ method_field('DELETE')}}
                                 <input type="hidden" name="id" value="">
                                <!--<button type="submit" class="btn btn-danger">ลบ</button>-->
                            </form>
                        </td>
                        
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</div>


@endsection


@section('scripts')

@endsection
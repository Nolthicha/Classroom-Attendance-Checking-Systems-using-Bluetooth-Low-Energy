@extends('layouts.template')


@section('title')
    Manage Subjects
@endsection



@section('content')


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/save-subject" method="POST">
            {{ csrf_field() }}

      <div class="modal-body">
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Subject ID:</label>
            <input name="subject_id" type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Subject Name:</label>
            <input name="subject_name" type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Year:</label>
            
            <select name="year" class="form-control">
            @for ($i = 2563; $i <= 2580; $i++)
                            <option value="{{$i}}" class="">{{$i}}</option>
            @endfor
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Term:</label>
            <select name="term" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>

            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Day:</label>
            <select name="day" class="form-control">
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
            <label for="recipient-name" class="col-form-label">Time Start:</label>
            <select name="time_start" class="form-control">
                            <option>08:30 น.</option>
                            <option>09:25 น.</option>
                            <option>10:20 น.</option>
                            <option>11:15 น.</option>
                            <option>12:10 น.</option>
                            <option>13:00 น.</option>
                            <option>13:55 น.</option>
                            <option>14:50 น.</option>
                            <option>15:45 น.</option>
                            <option>16:40 น.</option>
                            <option>17:35 น.</option> 
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Time End:</label>
            <select name="time_end" class="form-control">
                            <option>09:20 น.</option>
                            <option>10:15 น.</option>
                            <option>11:10 น.</option>
                            <option>12:05 น.</option>
                            <option>12:10 น.</option>
                            <option>12:55 น.</option>
                            <option>13:50 น.</option>
                            <option>14:45 น.</option>
                            <option>15:40 น.</option>
                            <option>16:35 น.</option>
                            <option>17:30 น.</option>
                            <option>18:55 น.</option> 
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Room:</label>
            <select name="room" class="form-control">
                            <option value="1641">1641</option>
                            <option value="1640">1640</option>
            </select>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">SAVE</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Subjects
                    <!--<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>-->
                </h4>
              </div>
                <style>
                    .w-10p{
                        width: 10% !important;
                    }

                </style>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="datatable" class="table">
                    <thead class=" text-primary">
                     
                    <th class="w-10p">ID</th>
                      <th class="w-10p">Subject Name</th>
                     
                      
                      
                     
                      <th class="w-10p">User Email</th>
                      <th class="w-10p">EDIT</th>
                      <th class="w-10p">DELETE</th>

                    </thead>
                    <tbody>
                        @foreach($subject as $data)
                      <tr>
                       
                      <td> {{ $data->subject_id }} </td>
                        <td> {{ $data->subject_name }} </td>
                        
                       
                        <td>{{ $data->user_email }}</td>

                        <td>
                            <a href="{{ url('subject-edit/'.$data->subject_id) }}" class="btn btn-success">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ url('subject-delete/'.$data->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE' )}}
                                <button type="submit" class="btn btn-danger">DELETE</button>

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
                    <script>
                        $(document).ready( function () {
                            $('#datatable').DataTable();
                        } );
                    </script>
@endsection
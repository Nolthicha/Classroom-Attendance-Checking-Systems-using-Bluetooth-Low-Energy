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
                <h3 class="card-title">วันที่สอน</h3>
                
                @foreach($subjectName as $name)
                วิชา {{ $name->subject_id }}
                {{ $name->subject_name }}
                @endforeach

                <p>
                <a href="{{  url('course/std_back_sub') }}">ย้อนกลับ </a>
                </p>
                </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                                   
                      
                      


                    </tr>
                  </thead>
                  <tbody>
                 

                  @foreach($std as $std)
                  
                  
                    <tr>

                    <td> <a href="{{  url('course/std_back_show/'.$std->tb_subject.'/'.$std->date_ble) }}">{{ $std->date_ble }}</a> </td>
                  
                  

                    

                    </tr>

                 
                @endforeach

               
              

                
                  </tbody>
                </table>
              
            </div>
        </div>
    </div>
</div>
                 
@endsection


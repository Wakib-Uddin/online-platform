@extends('student.layouts.two_col')
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Enroll Course</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="row">
    <div class="container">
          <div class="row justify-content-center">
            <div class=" col-md-8   align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">
                    @if(Session::has('info'))
                    <div class="alert alert-info">
                        <strong>{{ Session::get('info') }}</strong> 
                    </div>
                    @endif
                
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create a course</h5>
                  </div>
                  <form  method="post" action="{{ url('student/store-enroll'); }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    @csrf

                    <div class="col-12">
                        <div class="" align="center">
                            <select name = "session" class="form-select" align="center" id="session" aria-label="Default select example">
                            <option value=" " selected>--choose session--</option>
                                @foreach($sessions as $s)

                                    <option value="{{$s->id}}">{{$s->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

            

                    <table class="table table-striped" id="table" >
                        <thead>
                            <tr>
                                <th scope="col">Select</th>
                                <th scope="col">Course</th>
                                <th scope="col">Section</th>
                                <th scope="col">Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="create_course">
                            
                        </tbody>
                    </table>

                   

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="button">Enroll</button>
                    </div>
                    
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
              </div>

            </div>
          </div>
    </div>
    </section>
</main><!-- End #main -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#button").hide();
       
        $("#table").hide();

        $("#session").change(function(){
            $("#create_course").empty();
            var session_id = $(this).val();
            console.log(session_id);
            if(session_id!=" "){
               
                $("#button").show();
                $("#table").show();
                $.ajax({
                    url: 'http://127.0.0.1:8001/student/get-session-course/'+session_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        var len = response.courses.length;
                        console.log(response.courses);
                        var str = '';
                        for(var i=0;i<len;i++){
                            str+='<tr>'
                            str+='<td><input type="checkbox" id="checkbox'+response.courses[i].id+'" name="check[]" value="'+response.courses[i].id+'"></td>'
                            str+='<td>'+ response.courses[i].course+'</td>'
                            str+='<td>'+ response.courses[i].section+'</td>'
                            str+='<td>'+ response.courses[i].teacher+'</td>'
                            str+='</tr>';
                        }
                        $("#create_course").append(str);
                    }
                });
            }
            else{
               
                $("#button").hide();
                $("#table").hide();
            }
            

        });
    });

</script>
@endsection
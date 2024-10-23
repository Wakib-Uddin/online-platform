@extends('teacher.layouts.two_col')
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="row">
    <div class="container">
          <div class="row justify-content-center">
            <div class=" col-md-6 d-flex  align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">
                    @if(Session::has('scs'))
                    <div class="alert alert-info">
                        <strong>{{ Session::get('scs') }}</strong> 
                    </div>
                    @endif
                
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create a course</h5>
                  </div>
                  <form  method="post" action="{{ url('teacher/store-course'); }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    @csrf

                    <div class="col-12">
                        <div class="" align="center">
                            <select class="form-select" align="center" id="session" aria-label="Default select example">
                            <option value=" " selected>--choose session--</option>
                                @foreach($sessions as $s)

                                    <option value="{{$s->id}}">{{$s->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12" align="center">
                        <button type="button" class="btn btn-success" id="add_btn"><i class="fa fa-plus"></i></button>
                    </div>

                    <div id="create_course">

                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="button">Create</button>
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
        $("#add_btn").hide();

         $("#add_btn").click(function(){
            var str = '';
            str+= '<div class="col-12 mb-2" id="course_name">'
            str+= '<input type="text" name="course[]" class="form-control" id="course" required>'
            str+= '</div>';
            $("#create_course").append(str);
        });

        $("#session").change(function(){
            $("#create_course").empty();
            var session_id = $(this).val();
            $("#create_course").append('<input type="hidden" name="session_id" value="'+ session_id +'">');
            console.log(session_id);
            if(session_id!=" "){
                $("#add_btn").show();
                $.ajax({
                    url: 'http://127.0.0.1:8001/teacher/get-session-course/'+session_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        var len = response.courses.length;
                        console.log(response.courses);
                        var str = '';
                        for(var i=0;i<len;i++){
                            str+= '<div class="col-12 mb-2" id="course_name">'
                            str+= '<input type="text" name="course[]" class="form-control" value="'+response.courses[i].name+'" id="course" required>'
                            
                            str+= '</div>';
                        }
                        $("#create_course").append(str);
                    }
                });
                $("#button").show();
            }
            else{
                $("#add_btn").hide();
                $("#button").hide();
            }
            

        });
    });

</script>
@endsection
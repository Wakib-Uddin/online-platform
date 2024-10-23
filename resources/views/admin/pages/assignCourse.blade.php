@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Assign Course</li>
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
                  <form  method="post" action="{{ url('admin/store-assigncourse'); }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
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

                    <div class="col-12" align="center">
                        <button type="button" class="btn btn-success" id="add_btn"><i class="fa fa-plus"></i></button>
                    </div>

                    <table class="table table-striped" id="table" >
                        <thead>
                            <tr>
                                <th scope="col">Course</th>
                                <th scope="col">Section</th>
                                <th scope="col">Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="create_course">
                            
                        </tbody>
                    </table>

                   

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="button">Assign</button>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#button").hide();
        $("#add_btn").hide();
        $("#table").hide();

         $("#add_btn").click(function(){
            var str = '';
            str+='<tr>'
            str+='<td>'
            str+='<select name="course[]" class="form-select" align="center" id="session" aria-label="Default select example">'
            str+='<option value=" " selected>--choose course--</option>'
            str+='@foreach($courses as $c)'

            str+='<option value="{{$c->id}}">{{$c->name}}</option>'

            str+='@endforeach'
            str+='</select>'
            str+='</td>'
            str+='<td>'
            str+='<select name="section[]" class="form-select" align="center" id="session" aria-label="Default select example">'
            str+='<option value=" " selected>--choose section--</option>'
            str+='@foreach($sections as $ss)'

            str+='<option value="{{$ss->id}}">{{$ss->name}}</option>'

            str+='@endforeach'
            str+='</select>'
                    
            str+='</td>'
            str+='<td>'
            str+='<select name="teacher[]" class="form-select" align="center" id="session" aria-label="Default select example">'
            str+='<option value=" " selected>--choose teacher--</option>'
            str+='@foreach($teachers as $t)'

            str+='<option value="{{$t->id}}">{{$t->name}}</option>'

            str+='@endforeach'
            str+='</select>'
                    
            str+='</td>'
            str+='<td>'
                    
            str+='</td>'
            str+='</tr>';
            $("#create_course").append(str);
        });

        $("#session").change(function(){
            $("#create_course").empty();
            var session_id = $(this).val();
            console.log(session_id);
            if(session_id!=" "){
                $("#add_btn").show();
                $("#button").show();
                $("#table").show();
            }
            else{
                $("#add_btn").hide();
                $("#button").hide();
                $("#table").hide();
            }
            

        });
    });

</script>
@endsection
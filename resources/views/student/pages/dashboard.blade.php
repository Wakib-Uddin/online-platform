@extends('student.layouts.two_col')
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
                
                  <div class="pt-4 pb-2">
@if($student)
  <h5 class="card-title text-center pb-0 fs-4">Welcome {{$student->name}}</h5>
@else
  <h5 class="card-title text-center pb-0 fs-4">Student data not found.</h5>
@endif

                    
                    <p class="text-center small">Edit your information</p>
                  </div>
                  <form method="post" action="{{ url('student/update-profile'); }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div align="center">
                        <img src="{{ asset('thumbnail/'.$student->image) }}" alt="Profile" class="rounded-circle" height="250" width = "250">
                    </div>

                    <div align="center" >
                        <div class="col-sm-10" >
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" value={{$student->name}} required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" value={{$student->email}} required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Update Account</button>
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
@endsection
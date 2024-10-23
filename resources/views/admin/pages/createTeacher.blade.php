@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Create</a></li>
        <li class="breadcrumb-item active">Teacher</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="row">
        <div class="container">
          <div class="row justify-content-center">
            <div class=" col-md-6 d-flex  align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
                
                @if(Session::has('info'))
                <div class="alert alert-info">
                    <strong>{{ Session::get('info') }}</strong> 
                </div>
                @endif

                @if(Session::has('err'))
                <div class="alert alert-danger">
                    <strong>{{ Session::get('err') }}</strong> 
                </div>
                @endif

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create Teacher Account</h5>
                    <p class="text-center small">Enter teacher information</p>
                  </div>

                  <form method="post" action="{{ url('admin/store-teacher') }}" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourName" class="form-label">Teacher Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Teacher Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
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
        

    </div>
    </section>
</main><!-- End #main -->
@endsection
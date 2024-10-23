@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">

<div class="pagetitle">
  <h1>All Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Enrollments</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Courses</h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                <th scope="col">Session</th>
                <th scope="col">Student</th>
                <th scope="col">Course</th>
                <th scope="col">Section</th>
                <th scope="col">Teacher</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
              @foreach($enrolls as $c)
              <tr>
                <td>{{ $c->session }}</td>
                <td>{{ $c->student }}</td>
                <td>{{ $c->course }}</td>
                <td>{{ $c->section }}</td>
                <td>{{ $c->teacher }}</td>
                <td><a class="btn btn-success" href="{{ url('admin/enroll-approve/'.$c->id) }}">Approve</a></td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
@endsection
@section('scripts')
<script src="{{ asset('admin/assets/js/tables.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script >
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection
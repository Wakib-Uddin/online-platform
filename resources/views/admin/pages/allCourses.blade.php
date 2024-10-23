@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">

<div class="pagetitle">
  <h1>All Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Courses</li>
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
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
              @foreach($courses as $c)
              <tr>
                <td>{{ $c->code }}</td>
                <td>{{ $c->name }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ url('admin/edit-course/'.$c->id) }}">Edit</a>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$c->id}}">Delete</button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal{{$c->id}}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Delete Confirmation!!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            Do you really want to delete <b> {{$c->name}} </b> ? 
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <a class="btn btn-success" href="{{ url('admin/delete-course/'.$c->id) }}">Yes</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                </td>
                
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
@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">

<div class="pagetitle">
  <h1>All Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Students</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
            @if(Session::has('scs'))
                <div class="alert alert-info">
                    <strong>{{ Session::get('scs') }}</strong> 
                </div>
            @endif
          <h5 class="card-title">All Students</h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
               
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $u)
              <tr>
                <td> <img src="{{ asset('thumbnail/'.$u->image) }}" height="50" width="55" alt=""></td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                
                <td>
                  <a class="btn btn-primary" href="{{ url('admin/edit-student/'.$u->id) }}">Edit</a>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$u->id}}">Delete</button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal{{$u->id}}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Delete Confirmation!!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            Do you really want to delete <b> {{$u->name}} </b> ? 
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <a class="btn btn-success" href="{{ url('admin/delete-student/'.$u->id) }}">Yes</a>
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
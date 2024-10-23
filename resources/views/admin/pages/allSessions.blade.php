@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">

<div class="pagetitle">
  <h1>All Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Sessions</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Sessions</h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
               
              </tr>
            </thead>
            <tbody>
              @foreach($users as $u)
              <tr>
                <td>{{ $u->name }}</td>
                @if($u->status==0)
                    <td><a class="btn btn-success" href="{{ url('admin/update-session/'.$u->id) }}">Active</a></td>
                @else
                    <td><a class="btn btn-danger" href="{{ url('admin/update-session/'.$u->id) }}">Deactive</a></td>
                @endif
                
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
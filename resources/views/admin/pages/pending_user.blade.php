@extends('admin.layouts.two_col')

@section('main')

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pending Users</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pending Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending_user as $u)
                    <tr>
                        <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if($u->status)
                            <span class= "badge badge-success">1</span>

                            @else
                            <span class= "badge badge-danger">0</span>

                            @endif


                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ url('admin/approve-users/'.$u->id) }}"> Approve</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>


@endsection


@section('scripts')

<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>

@endsection
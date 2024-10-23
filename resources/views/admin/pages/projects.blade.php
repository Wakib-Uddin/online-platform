@extends('admin.layouts.two_col')
@section('main')
<main id="main" class="main">

<div class="pagetitle">
  <h1>All Projects</h1>
  <nav>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Projects</h5>

          
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Project_id</th>
                <th scope="col">Member_id</th>
                <th scope="col">Member_name</th>
                <th scope="col">Project_Title</th>
                <th scope="col">Project_Description</th>
                <th scope="col">Approved?</th>
              </tr>
            </thead>
            <tbody>
              @foreach($projects as $p)
                  @foreach($p->members as $member)
                      <tr>
                          <td>{{ $member->project_id }}</td>
                          <td>{{ $member->member_id }}</td>
                          <td>{{ $member->member_name }}</td>
                          <td>{{ $p->title }}</td>
                          <td>{{ $p->description }}</td>
                          <td>
                              @if($p->is_approved == 0)
                                  <a href="#" onclick="approveProject( '{{ $p->id }}' ), '{{ $p->title }}',('{{ $member->member_name}}')">Approve</a>
                              @else
                                  Approved
                              @endif
                          </td>
                      </tr>
                  @endforeach
              @endforeach
            </tbody>
          </table>
        
        </div>
      </div>

    </div>
  </div>
</section>

</main>
@endsection


<script>
    function approveProject(id, title, memberName) {
        var message = "Are you sure you want to approve project \"" + title + "\" for member \"" + memberName + "\"?";
        if (confirm(message)) {
            // If user clicks "OK" on the confirm box, redirect to the approval URL
            window.location.href = "{{ url('admin/project/') }}/" + id;
        }
    }
</script>

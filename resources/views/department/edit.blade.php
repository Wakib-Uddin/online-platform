<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Department</h2>
        <form action="{{ url('/department/update') }}/{{ $departments->id }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="dept_name" class="form-control" value="{{ $departments->name }}" >

                <span class="text-danger">
                        @error('dept_name')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="">Code</label>
                <input type="text" name="code" class="form-control" value="{{ $departments->code }}"  >

                <span class="text-danger">
                        @error('code')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="">Established</label>
                <input type="date" name="established" class="form-control" value="{{ $departments->established_at }}">

                <span class="text-danger">
                        @error('established')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">Update</button>
            </div>

        </form>
    </div>
</body>
</html>
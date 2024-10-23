<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create New Department</h2>
        <form action="{{ url('/department/store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="dept_name" class="form-control">

                <span class="text-danger">
                        @error('dept_name')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="">Code</label>
                <input type="text" name="code" class="form-control">

                <span class="text-danger">
                        @error('code')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="">Established</label>
                <input type="date" name="established" class="form-control">

                <span class="text-danger">
                        @error('established')
                        {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>

        </form>
    </div>
</body>
</html>
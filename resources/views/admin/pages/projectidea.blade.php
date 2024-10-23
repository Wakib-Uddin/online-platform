<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
        <h3>Project Idea</h3>
        <form action="{{ url('store-employee') }}" enctype="multipart/form-data" method="post">
            @csrf 
            <div class="form-group">
                <label for="">Group Name</label>
                <input type="text" name="group_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Group Members</label>
                <input type="tel" name="group_members" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Project Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Project Description</label>
                <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</body>
</html>
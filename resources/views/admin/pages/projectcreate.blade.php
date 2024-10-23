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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
<style>

body {background-color: rgb(211, 211, 211);
   
}
.title-design{
    font-size: 20px;
}
#head{
    font-size: 30px;
    color:blue;
}
.form-control{
    background-color: #ececec;
}
.form-container{
  padding:10px;
  padding-bottom:15px;
  margin:0 auto;
  margin-top:20px;
  width:100%;
  border-radius:20px;
  background-color: #ececec;
}

.add-one{
  color:green;
  text-align:center;
  font-weight:bolder;
  cursor:pointer;
  margin-top:15px;
}

.delete{
  color:white;
  background-color:rgb(231, 76, 60);
  text-align:center;
  margin-top:30px;
  font-weight:700;
  border-radius:5px;
  min-width:20px;
  cursor:pointer;
}
#delete{
    background-color:red;
}

#singlebutton{
  width:100%;
  margin-top:20px;
}

.title{
  text-align:center;
  font-style: bold;
  font-size:25px;
  margin-bottom:20px;
}

.dynamic-element{
  margin-bottom:0px;
}
#submit-button{
    margin-bottom:10px;
}
.container{
    background-color: #ececec;
    padding: 25px 110px;
    margin-top:90px;
    border-radius:20px;
    margin-left:500px;
   
}

</style>


<div class="container">
    <h3 id="head">Project Idea Submit</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('admin/project_submit') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title" class="title-design">Project Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter project title">
    </div>

    <div class="form-group">
        <label for="description" class="title-design">Project Description</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Enter project description"></textarea>
    </div>

    <div class="dynamic-stuff">
        <div class="form-group member">
            <label class="title-design" >Member 1</label> <br>
            <input type="text" name="member_id[]" class="form-control" placeholder="Enter member Id">
            <input type="text" name="member_name[]" class="form-control" placeholder="Enter member name">
        </div>
    </div>

    <button type="button" id="add-member" class="btn btn-primary mb-3">Add Member</button>
    <button type="button" id="delete" class="btn btn-primary mb-3">Remove Member</button>

    <button type="submit" id ="submit-button"class="btn btn-success">Submit</button>
    </form>
</div>

<script>      
    var memberCount = 1;

    // Add Member
    $('#add-member').click(function(){
        memberCount++;
        var newElement = $('.member').first().clone();
        newElement.find(':input').each(function(){
            var inputName = $(this).attr('name');
            if (inputName) {
                inputName = inputName.replace(/\[\d+\]/, '[' + memberCount + ']');
                $(this).attr('name', inputName);
                $(this).val('');
            }
        });
        newElement.find('label').text('Member ' + memberCount);
        newElement.appendTo('.dynamic-stuff').show();
    });

    // Remove Member
const deleteButton = document.getElementById("delete");

deleteButton.addEventListener("click", function() {
  $('.member').last().remove();
  memberCount--;
});

const submitButton = document.getElementById("submit-button");

submitButton.addEventListener("click", function() {
  if (confirm("Are you sure you want to submit the Project Idea?")) {
    document.getElementById("project-submit-form").submit();
  }
});
</script>




</body>
</html>
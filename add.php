<?php
include "conn.php";

if (isset($_POST["submit"])) {
   $id = $_POST['id'];
   $title = $_POST['title'];
   $description = $_POST['description'];
   $status = $_POST['status'];
   $created_at = $_POST['created_at'];

   $sql= "INSERT INTO tasks (title, description, status) VALUES ($title, $description, $status)";
   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">title</label>
    <input type="email" class="form-control" placeholder="Enter title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">description</label>
    <input type="password" class="form-control" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">status</label>
    <input type="password" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">created_at</label>
    <input type="password" class="form-control" >
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> 
</body>
</html>
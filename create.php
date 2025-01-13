<?php
include "connection.php";

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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Add task</h3>
     
    </div>

    <div class="container d-flex justify-content-center">
      <form action="index.php" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label"> id</label>
            <input type="text" class="form-control" name=" id" >
          </div>

          <div class="col">
            <label class="form-label">title</label>
            <input type="text" class="form-control" name="title" >
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">description</label>
          <input type=" text" class="form-control" name=" status" >
        </div>

        <div class="form-group mb-3">
          <label> status</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="status"
          <label >Pending</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="status"  
          <label>In Progress</label>
        </div>
        &nbsp;
          <input type="radio" class="form-check-input" name="status"
          <label>Completed</label>
          &nbsp;
        <div>
        

          <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
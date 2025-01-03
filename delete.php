<?php
include "conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `tasks` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Task deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

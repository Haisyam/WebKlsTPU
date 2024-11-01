<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  try {
    $sql = "DELETE FROM pengurus WHERE id = $id";

    if ($conn->query($sql)) {
      echo "<script>alert('deleted successfully.'); window.location.href='index.php';</script>";
    } else {
      echo "Error deleting.";
    }
  } catch (mysqli_sql_exception) {
    echo "Error deleting.";
  }

  $conn->close();
} else {
  echo "Invalid ID.";
}

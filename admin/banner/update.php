<?php
include '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="user:language" content="in" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../../src/style/output.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
    rel="stylesheet"
    type="text/css" />
  <title>Update Banner</title>
</head>

<body>
  <?php include '../nav-new.php' ?>
  <div class="container text-center">
    <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Update Banner</h1>
  </div>
  <div class="container mx-auto">
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM banner WHERE id=$id";
      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    ?>
        <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
          <div class="pb-5">
            <label for="title" class="block">Nama Kelas</label>
            <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="input input-bordered w-full max-w-x" />
          </div>
          <div class="pb-5">
            <label for="subtitle">Slogan</label>
            <input type="text" name="subtitle" id="subtitle" value="<?php echo $row['subtitle']; ?>" class="input input-bordered w-full max-w-xs" />
          </div>
          <div class="pb-5">
            <label for="image">Foto Banner</label>
            <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" />
          </div>
          <div class="">
            <button type="submit" name="submit" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-warning">Back</a>
          </div>
        </form>
  </div>
</body>
<?php
      } else {
        echo "Image not found.";
      }
    }

    if (isset($_POST['submit'])) {
      $id = $_GET['id'];
      $title = $_POST['title'];
      $subtitle = $_POST['subtitle'];
      $image = $_FILES['image']['name'];
      $target_dir = "../../uploads/";
      $target_file = $target_dir . basename($image);

      if ($image) {
        // Get old image path
        $sql = "SELECT image_path FROM banner WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $old_image_path = $row['image_path'];

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
          $sql = "UPDATE banner SET title='$title', subtitle='$subtitle', image_path='$image' WHERE id=$id";

          if ($conn->query($sql) === TRUE) {
            // Delete old image
            unlink($target_dir . $old_image_path);
            echo "<script>alert('Image updated successfully.'); window.location.href='index.php';</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        } else {
          echo "Error uploading file.";
        }
      } else {
        $sql = "UPDATE banner SET title='$title', subtitle='$subtitle' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Image updated successfully.'); window.location.href='index.php';</script>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

      $conn->close();
    }
?>

</html>
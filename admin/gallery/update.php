<?php
        include '../../config.php'
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="../../src/style/output.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
    rel="stylesheet"
    type="text/css"
  />
  <title>Edit Gallery #1</title>
</head>
<body>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Edit Gallery #1</h1>
</div>
<div class="container mx-auto">
<?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM gallery_1 WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                ?>
  <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
    <div class="pb-5">
      <label for="image">Foto</label>
      <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" />
    </div>
    <div class="">
      <button type="submit" name="submit" class="btn btn-success">Create</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
  </form>
  <?php
            } else {
                echo "Image not found.";
            }
        }

        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $image = $_FILES['image']['name'];
            $target_dir = "../../uploads/";
            $target_file = $target_dir . basename($image);

            if ($image) {
                // Get old image path
                $sql = "SELECT image_path FROM gallery_1 WHERE id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $old_image_path = $row['image_path'];

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $sql = "UPDATE gallery_1 SET image_path='$image' WHERE id=$id";

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

            }

            $conn->close();
        }
        ?>
</div>
</body>
</html>
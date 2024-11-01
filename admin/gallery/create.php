<?php
    if (isset($_POST['submit'])) {
        include '../../config.php';
      
        $image = $_FILES['image']['name'];
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO gallery_2 (image_path) VALUES ('$image')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Image uploaded successfully.'); window.location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
        
        $conn->close();
    }
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
  <title>Tambah Gallery #2</title>
</head>
<body>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Tambah Gallery</h1>
</div>
<div class="container mx-auto">
  <form action="create.php" method="POST" enctype="multipart/form-data">
    <div class="pb-5">
      <label for="image">Foto</label>
      <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" />
    </div>
    <div class="">
      <button type="submit" name="submit" class="btn btn-success">Create</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
  </form>
</div>
</body>
</html>
<?php
include '../../config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Kelola Pengurus</title>
  </head>
  <body>
  <?php include '../nav-new.php' ?>
    <div class="container mx-auto">
      <div class="container text-center">
        <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Gallery #1</h1>
      </div>
      <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th>
                <!-- <a href="create.php" class="btn btn-xs btn-success">+</a> -->
              </th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM gallery_1 ORDER BY created_at DESC";
            $i = 1;
            $query = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($query)):
            ?>
            
            <tr>
              <th><?= $i++ ?></th>
              <td>
                <img src="../../uploads/<?= $data['image_path'] ?>" alt="" style="width: 80px !important; height: 80px !important;">
              </td>
              <td>
                <a href="update.php?id=<?= $data['id'] ?>" type="submit" name="submit" class="btn btn-sm btn-warning">Edit</a>
                <!-- <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-error">Delete</a> -->
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <div class="container text-center mt-5">
        <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Gallery #2</h1>
      </div>
      <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th><a href="create.php" class="btn btn-xs btn-success">+</a></th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM gallery_2 ORDER BY created_at DESC";
            $i = 1;
            $query = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($query)):
            ?>
            
            <tr>
              <th><?= $i++ ?></th>
              <td>
                <img src="../../uploads/<?= $data['image_path'] ?>" alt="" style="width: 80px !important; height: 80px !important;">
              </td>
              <td>
                <a href="update.php?id=<?= $data['id'] ?>" type="submit" name="submit" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-error">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>

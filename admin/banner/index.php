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
    <title>Kelola Banner</title>
  </head>
  <body>
  <?php include '../nav-new.php' ?>
    <div class="container mx-auto">
      <?php
      $sql = "SELECT * FROM banner ORDER BY created_at DESC";
      $result = $conn->query($sql);
      $query = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_assoc($query)):
      ?>
      <div class="card card-compact bg-base-100 shadow-xl">
        <figure>
          <img
            src="../../uploads/<?= $data['image_path'] ?>"
            class="w-28 h-28"
            alt="Shoes" />
        </figure>
        <div class="card-body">
          <h2 class="card-title"><?= $data['title'] ?></h2>
          <p><?= $data['subtitle'] ?></p>
          <div class="card-actions justify-end">
          <a href="update.php?id=<?= $data['id'] ?>" type="submit" name="submit" class="btn btn-sm btn-warning">Edit</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </body>
</html>

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
    rel="stylesheet" />
  <link rel="stylesheet" href="../../src/style/output.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
    rel="stylesheet"
    type="text/css" />
  <title>Kelola Piket</title>
</head>

<body>
  <?php include '../nav-new.php' ?>
  <div class="container mx-auto">
    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th><a href="create.php" class="btn btn-xs btn-success">+</a></th>
            <th>Hari</th>
            <th>Nama Siswa</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM jadwal_piket
                    LEFT JOIN nama_siswa ON jadwal_piket.id_siswa = nama_siswa.id_siswa 
                    LEFT JOIN hari ON jadwal_piket.id_hari = hari.id_hari";
          $i = 1;
          $query = mysqli_query($conn, $sql);
          while ($data = mysqli_fetch_assoc($query)):
          ?>

            <tr>
              <th><?= $i++ ?></th>
              <td><?= $data['nama_hari'] ?></td>
              <td><?= $data['nama'] ?></td>
              <td>
                <a href="update.php?id=<?= $data['id_piket'] ?>" type="submit" name="submit" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $data['id_piket'] ?>" class="btn btn-sm btn-error">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
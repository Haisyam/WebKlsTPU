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
    rel="stylesheet" />
  <link rel="stylesheet" href="../../src/style/output.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
    rel="stylesheet"
    type="text/css" />
  <title>Tambah Piket</title>
</head>

<body>
  <?php include '../nav-new.php' ?>
  <div class="container text-center">
    <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Tambah Piket</h1>
  </div>
  <div class="container mx-auto">
    <form method="POST">
      <div class="pb-5">
        <label for="nama_hari" class="block">Hari</label>
        <select name="nama_hari" id="nama_hari" class="select select-bordered w-full max-w-xs">
          <option value="" selected disabled>Pilih Hari</option>
          <?php
          $sql = "SELECT * FROM hari";
          $query = mysqli_query($conn, $sql);
          while ($hari = mysqli_fetch_assoc($query)):
          ?>
            <option value="<?= $hari['id_hari'] ?>"><?= $hari['nama_hari'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="pb-5">
        <label for="id_siswa">Siswa</label>
        <select name="id_siswa" id="id_siswa" class="select select-bordered w-full max-w-xs">
          <option value="" selected disabled>Pilih Siswa</option>
          <?php
          $sql = "SELECT * FROM nama_siswa";
          $query = mysqli_query($conn, $sql);
          while ($nama_siswa = mysqli_fetch_assoc($query)):
          ?>
            <option value="<?= $nama_siswa['id_siswa'] ?>"><?= $nama_siswa['nama'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="">
        <button type="submit" name="submit" class="btn btn-success">Create</button>
        <a href="index.php" class="btn btn-warning">Back</a>
      </div>
    </form>
  </div>
</body>
<?php
if (isset($_POST['submit'])) {
  $nama_hari = $_POST['nama_hari'];
  $id_siswa = $_POST['id_siswa'];

  $sql = "INSERT INTO jadwal_piket (id_siswa, id_hari) VALUES ('$id_siswa', '$nama_hari')";
  $query = mysqli_query($conn, $sql);
  if ($query > 0) {
    echo "<script>alert('Create updated successfully.'); window.location.href='index.php';</script>";
  } else {
    echo "Error uploading.";
  }
  $conn->close();
}
?>

</html>
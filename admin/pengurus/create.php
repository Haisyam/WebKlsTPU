<?php
include '../../config.php';

if (isset($_POST["submit"])) {
  $jabatan = $_POST["jabatan"];
  $nama = $_POST["nama"];
  $warna = $_POST["warna"];

  try {
    $sql = "INSERT INTO pengurus (jabatan, nama, warna) VALUES ('$jabatan', '$nama', '$warna')";

    if ($conn->query($sql)) {
      echo "<script>alert('FAQ updated successfully.'); window.location.href='index.php';</script>";
    } else {
      echo "Error uploading.";
    }
  } catch (mysqli_sql_exception) {
    echo "Error uploading.";
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
  <title>Tambah Pengurus</title>
</head>
<body>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Tambah Pengurus</h1>
</div>
<div class="container mx-auto">
  <form method="POST">
    <div class="pb-5">
      <label for="jabatan" class="block">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" placeholder="Ketua" class="input input-bordered w-full max-w-x" />
    </div>
    <div class="pb-5">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="jabatan" placeholder="Ahmad Asep" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="warna">Warna Latar</label>
      <input type="text" name="warna" id="warna" placeholder="blue" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="">
      <button type="submit" name="submit" class="btn btn-success">Create</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
  </form>
</div>
</body>
</html>
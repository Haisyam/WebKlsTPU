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
  <title>Tambah Mapel</title>
</head>
<body>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Tambah Mapel</h1>
</div>
<div class="container mx-auto">
  <form method="POST">
    <div class="pb-5">
      <label for="nama_hari" class="block">Pilih Hari</label>
      <select name="nama_hari" id="nama_hari" class="select select-bordered w-full max-w-xs">
        <option value="" selected disabled >Pilih</option>
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
      <label for="jam_awal">Jam Awal</label>
      <input type="time" id="jam_awal" name="jam_awal" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="nama">Jam Akhir</label>
      <input type="time" id="jam_akhir" name="jam_akhir" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="id_mapel">Warna Latar</label>
      <select name="id_mapel" id="id_mapel" class="select select-bordered w-full max-w-xs">
        <option value="" selected disabled>Pilih Mata Pelajaran</option>
        <?php
        $sql = "SELECT * FROM mapel";
        $query = mysqli_query($conn, $sql);
        while ($mapel = mysqli_fetch_assoc($query)):
        ?>
        <option value="<?= $mapel['id_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
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
  $jam_awal = $_POST['jam_awal'];
  $jam_akhir = $_POST['jam_akhir'];
  $id_mapel = $_POST['id_mapel'];

  $sql = "INSERT INTO jam_mapel (jam_awal, jam_akhir) VALUES ('$jam_awal', '$jam_akhir')";
  $query = mysqli_query($conn, $sql);
  if ($query > 0) {
    $sql = "SELECT * FROM jam_mapel WHERE jam_awal = '$jam_awal'";
    $query = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $id_jam = $query['id_jam'];
    $sql = "INSERT INTO jadwal_pelajaran (id_hari, id_jam, id_mapel) VALUES ('$nama_hari', '$id_jam', '$id_mapel')";

    if ($conn->query($sql)) {
      echo "<script>alert('Create updated successfully.'); window.location.href='index.php';</script>";
    } else {
      echo "Error uploading.";
    }
  }
  $conn->close();
}
?>
</html>
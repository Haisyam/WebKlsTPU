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
  <title>Ubah Mapel</title>
</head>
<body>
<?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM jadwal_pelajaran
          LEFT JOIN hari ON jadwal_pelajaran.id_hari = hari.id_hari
          LEFT JOIN jam_mapel ON jadwal_pelajaran.id_jam = jam_mapel.id_jam
          LEFT JOIN mapel ON jadwal_pelajaran.id_mapel = mapel.id_mapel
          WHERE jadwal_pelajaran.id_japel = '$id'";
  $query = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($query);
  ?>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Ubah Mapel</h1>
</div>
<div class="container mx-auto">
  <form method="POST">
    <div class="pb-5">
      <label for="nama_hari" class="block">Pilih Hari</label>
      <select name="nama_hari" id="nama_hari" class="select select-bordered w-full max-w-xs">
        <option value="" selected disabled>Pilih</option>
        <?php
        $sql = "SELECT * FROM hari";
        $query = mysqli_query($conn, $sql);
        while ($hari = mysqli_fetch_assoc($query)):
        ?>
          <option <?= ($hari['nama_hari'] == $data['nama_hari']) ? 'selected' : '' ?> value="<?= $hari['id_hari'] ?>"><?= $hari['nama_hari'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="pb-5">
      <label for="jam_awal">Jam Awal</label>
      <input type="time" id="jam_awal" name="jam_awal" value="<?= $data['jam_awal'] ?>" class="input input-bordered w-full max-w-xs" />
      <input type="hidden" name="jam_awal_old" id="jam_awal_old" value="<?= $data['jam_awal'] ?>" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="nama">Jam Akhir</label>
      <input type="time" id="jam_akhir" name="jam_akhir" value="<?= $data['jam_akhir'] ?>" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="id_mapel">Mata Pelajaran</label>
      <select name="id_mapel" id="id_mapel" class="select select-bordered w-full max-w-xs">
        <option value="" selected disabled>Pilih Mata Pelajaran</option>
        <?php
        $sql = "SELECT * FROM mapel";
        $query = mysqli_query($conn, $sql);
        while ($mapel = mysqli_fetch_assoc($query)):
        ?>
          <option <?= ($mapel['nama_mapel'] == $data['nama_mapel']) ? 'selected' : '' ?> value="<?= $mapel['id_mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="">
      <button type="submit" name="update" class="btn btn-success">Create</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
  </form>
</div>
</body>
<?php
if (isset($_POST['update'])) {
  $nama_hari = $_POST['nama_hari'];
  $jam_awal_old = $_POST['jam_awal_old'];
  $jam_awal = $_POST['jam_awal'];
  $jam_akhir = $_POST['jam_akhir'];
  $id_mapel = $_POST['id_mapel'];

  $sql = "UPDATE jam_mapel SET jam_awal = '$jam_awal', jam_akhir = '$jam_akhir' WHERE jam_awal = '$jam_awal_old'";
  $query = mysqli_query($conn, $sql);
  if ($query > 0) {
    $sql = "SELECT * FROM jam_mapel WHERE jam_awal = '$jam_awal'";
    $query = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $id_jam = $query['id_jam'];
    $sql = "UPDATE jadwal_pelajaran SET id_hari = '$nama_hari', id_jam = '$id_jam', id_mapel = '$id_mapel' WHERE id_japel = '$id'";

    if ($conn->query($sql)) {
      echo "<script>alert('updated successfully.'); window.location.href='index.php';</script>";
    } else {
      echo "Error uploading.";
    }
  }
  $conn->close();
}
?>
</html>
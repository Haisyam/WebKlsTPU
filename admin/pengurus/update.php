<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the existing data for the given ID
  $sql = "SELECT * FROM pengurus WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jabatan = $row['jabatan'];
    $nama = $row['nama'];
    $warna = $row['warna'];
  } else {
    echo "<script>alert('No record found!'); window.location.href='index.php';</script>";
  }
}

if (isset($_POST["submit"])) {
  $jabatan = $_POST["jabatan"];
  $nama = $_POST["nama"];
  $warna = $_POST["warna"];

  try {
    $sql = "UPDATE pengurus SET jabatan='$jabatan', nama='$nama', warna='$warna' WHERE id=$id";

    if ($conn->query($sql)) {
      echo "<script>alert('updated successfully.'); window.location.href='index.php';</script>";
    } else {
      echo "Error updating record.";
    }
  } catch (mysqli_sql_exception $e) {
    echo "Error updating record: " . $e->getMessage();
  }
  $conn->close();
}
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
    rel="stylesheet"
  />
  <link rel="stylesheet" href="../../src/style/output.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
    rel="stylesheet"
    type="text/css"
  />
  <title>Update Pengurus</title>
</head>

<body>
<?php include '../nav-new.php' ?>
<div class="container text-center">
  <h1 class="text-white font-jkt font-semibold text-3xl pb-5">Update Pengurus</h1>
</div>
<div class="container mx-auto">
  <form action="update.php?id=<?php echo $id; ?>" method="POST" >
    <div class="pb-5">
      <label for="jabatan" class="block">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" value="<?php echo $jabatan; ?>" class="input input-bordered w-full max-w-x" />
    </div>
    <div class="pb-5">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="jabatan" value="<?php echo $nama; ?>" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="pb-5">
      <label for="warna">Warna Latar</label>
      <input type="text" name="warna" id="warna" value="<?php echo $warna; ?>" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="">
      <button type="submit" name="submit" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </div>
  </form>
</div>
</body>

</html>
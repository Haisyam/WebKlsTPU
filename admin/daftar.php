<?php
include ".././config.php";
$register_message = "";

if (isset($_POST["daftar"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $enc_password = hash("sha256", $password);

  try {
    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$enc_password')";

    if ($conn->query($sql)) {
      $register_message = "Daftar akun berhasil, silahkan login";
    } else {
      $register_message = "Daftar akun gagal, silahkan coba lagi!";
    }
  } catch (mysqli_sql_exception) {
    $register_message = "Daftar akun gagal, username sudah ada!";
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://exif-c.xdev.my.id/src/style/output.css" />
  <link rel="stylesheet" href="../src/style/output.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet" />
  <title>Administrator - Sign Up</title>
</head>

<body class="font-mulish">
  <!-- <nav
    id="navbar"
    class="bg-transparent flex items-center justify-center fixed top-5 left-0 w-full z-50 transition duration-400 ease-in-out">
    <div
      class="bg-black border border-gray-700 rounded-full px-4 py-2 flex items-center space-x-5">
      <a
        href="../index.html"
        class="text-white font-medium hover:text-gray-300">Home</a>
      <a
        href="../index.html#anggota"
        class="text-white font-medium hover:text-gray-300">Anggota</a>
      <a
        href="../index.html#galery"
        class="text-white font-medium hover:text-gray-300">Galery</a>
      <a
        href="login.php"
        class="font-medium border border-gray-700 rounded-full px-4 py-1 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-transparent">
        Login
      </a>
    </div>
  </nav> -->
  <!-- <div class="bg-gray-900 flex items-center justify-center h-screen"> -->
  <div
    class="bg-black flex items-center justify-center h-screen text-white bg-cover bg-no-repeat"
    style="
        background-image: url('../src/assets/images/anu.svg');
        min-height: 100vh;
      ">
    <div class="glass p-8 rounded-lg shadow-lg w-96">
      <!-- <h2 class="text-2xl font-bold text-white text-center mb-6">Login</h2> -->
      <div class="text-center flex justify-center">
        <h1
          class="mb-5 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-md lg:text-2xl font-extrabold text-transparent">
          Sign Up <span class="text-white text-4xl text-end">Admin</span>
        </h1>
      </div>
      <form action="daftar.php" method="POST">
        <i class="mt-2 text-sm text-red-700"><?= $register_message ?></i>
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
          <input
            type="number"
            id="username"
            name="username"
            class="w-full p-2 mt-1 bg-gray-700 border border-gray-600 text-white rounded focus:outline-none focus:ring focus:ring-blue-500"
            required />
        </div>
        <div class="mb-6">
          <label
            for="password"
            class="block text-sm font-medium text-gray-300">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full p-2 mt-1 bg-gray-700 border border-gray-600 text-white rounded focus:outline-none focus:ring focus:ring-blue-500"
            required />
        </div>
        <button
          type="submit"
          id="submit"
          name="daftar"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          Sign Up
        </button>
      </form>
      <p class="text-gray-400 mt-4 text-center">
        Sudah puya account?
        <a href="./login.php" class="text-blue-500 hover:underline">Login</a>
      </p>
    </div>
  </div>
</body>

</html>
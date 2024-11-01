<?php
include ".././config.php";
session_start();
$login_message = "";

if (isset($_SESSION["is_login"])) {
  header("location: ../admin/index.php");
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $enc_password = hash("sha256", $password);

  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$enc_password'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $_SESSION["username"] = $data["username"];
    $_SESSION["is_login"] = true;

    header("location: ../admin/index.php");
  } else {
    $login_message = "Salah Woyyy!";
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
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet" />
  <title>Administrator - Login</title>
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
        href="daftar.php"
        class="font-medium border border-gray-700 rounded-full px-4 py-1 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-transparent">
        Sign Up
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
      <div class="text-center flex justify-center">
        <h1
          class="mb-5 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-md lg:text-2xl font-extrabold text-transparent">
          Login <span class="text-white text-4xl text-end">Admin</span>
        </h1>
      </div>
      <form action="login.php" method="POST">
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= $login_message ?></p>
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
          <input
            type="number"
            id="username"
            name="username"
            class="w-full p-2 mt-1 bg-gray-700 border border-gray-600 text-white rounded focus:outline-none focus:ring focus:ring-blue-500" />
        </div>
        <div class="mb-6">
          <label
            for="password"
            class="block text-sm font-medium text-gray-300">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full p-2 mt-1 bg-gray-700 border border-gray-600 text-white rounded focus:outline-none focus:ring focus:ring-blue-500" />
        </div>
        <button
          type="submit"
          name="login"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          Login
        </button>
      </form>
      <p class="text-gray-400 mt-4 text-center">
        Belum punya account?
        <a href="daftar.php" class="text-blue-500 hover:underline">Sign up</a>
      </p>
    </div>
  </div>
</body>

</html>
<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme="light">

<head>
  <?php
  include 'layout/head.html';
  ?>
</head>

<body>
  <button
    id="tombol"
    href="#"
    class="border-none bg-transparent z-50 fixed block cursor-pointer">
    <svg
      class="bottom-5 right-5 z-50 fixed block"
      xmlns="http://www.w3.org/2000/svg"
      height="32"
      width="32"
      viewBox="0 0 512 512">
      <path
        d="M192 93.7C192 59.5 221 0 256 0c36 0 64 59.5 64 93.7l0 66.3L497.8 278.5c8.9 5.9 14.2 15.9 14.2 26.6v56.7c0 10.9-10.7 18.6-21.1 15.2L320 320v80l57.6 43.2c4 3 6.4 7.8 6.4 12.8v42c0 7.8-6.3 14-14 14c-1.3 0-2.6-.2-3.9-.5L256 480 145.9 511.5c-1.3 .4-2.6 .5-3.9 .5c-7.8 0-14-6.3-14-14V456c0-5 2.4-9.8 6.4-12.8L192 400V320L21.1 377C10.7 380.4 0 372.7 0 361.8V305.1c0-10.7 5.3-20.7 14.2-26.6L192 160V93.7z" />
    </svg>
  </button>

  <?php
  include 'layout/nav.php';
  ?>

  <div class="bg-white" style="transform: translateZ(0)">
    <?php
    $sql = "SELECT * FROM banner ORDER BY id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='flex flex-col justify-center content-center h-screen bg-no-repeat bg-cover bg-center bg-white' style='background-image: url(uploads/" . $row['image_path'] . ")'>";
        echo "<h1 class='z-10 text-center text-6xl md:text-7xl font-jkt font-bold text-white'>" . $row['title'] . "</h1>";
        echo "<h3 class='z-10 text-center text-white font-jkt font-bold'>" . $row['subtitle'] . "</h3>";
        echo "</div>";
      }
    } else {
      echo "";
    }
    ?>
  </div>

  <div id="struktur" class="container mx-auto">
    <h3
      class="mt-10 text-center md:text-2xl lg:text-2xl xl:text-4xl text-lg text-gray-700 font-jkt font-bold">
      Susunan Kepengurusan Kelas
    </h3>
    <p class="text-center font-jkt mt-1">
      ini susunan Kepengurusan Kelas <strike>kita</strike> kami cekidot
      geys...
    </p>
  </div>

  <div class="container mx-auto">
    <div class="bg-white mt-5 p-6 rounded-lg shadow-lg">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php
        $sql = "SELECT * FROM pengurus WHERE id = 1 ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<div class='col-span-1 md:col-span-2 text-center'>";
            echo "<div class='p-4 bg-" . $row['warna'] . "-800 text-white rounded-lg shadow-md'>";
            echo "<h2 class='text-xl font-semibold'>" . $row['jabatan'] . "</h2>";
            echo "<p>" . $row['nama'] . "</p>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "";
        }

        $sql2 = "SELECT * FROM pengurus WHERE id > 1 ORDER BY id ASC";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
          while ($row = $result2->fetch_assoc()) {
            echo "<div class='col-span-1 text-center'>";
            echo "<div class='p-4 bg-" . $row['warna'] . "-500 text-white rounded-lg shadow-md'>";
            echo "<h2 class='text-xl font-semibold'>" . $row['jabatan'] . "</h2>";
            echo "<p>" . $row['nama'] . "</p>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "";
        }
        ?>
      </div>
    </div>
  </div>

  <div id="mapel" class="container mx-auto mt-10">
    <h3
      class="text-center md:text-2xl lg:text-2xl xl:text-4xl text-lg text-gray-700 font-jkt font-bold">
      Jadwal Pelajaran
    </h3>
    <p class="text-center font-jkt">
      ini jadwal kelas <strike>kita</strike> kami, dan
      <b>hari Sabtu/Minggu </b> adalah hari yang paling menyenangkan
    </p>
  </div>
  <div class="container mx-auto">
    <div class="bg-white mt-5 p-6 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
              // Fungsi untuk mengambil semua hari
              function getAllHari($conn)
              {
                $sql = "SELECT * FROM hari";
                return mysqli_query($conn, $sql);
              }

              // Fungsi untuk mengambil jadwal berdasarkan hari
              function getJadwalByHari($conn, $id_hari)
              {
                $sql = "SELECT * FROM jadwal_pelajaran 
                        LEFT JOIN jam_mapel ON jadwal_pelajaran.id_jam = jam_mapel.id_jam
                        LEFT JOIN mapel ON jadwal_pelajaran.id_mapel = mapel.id_mapel
                        WHERE jadwal_pelajaran.id_hari = '$id_hari'";

                return mysqli_query($conn, $sql);
              }

              // Ambil semua hari dari database
              $hariResult = getAllHari($conn);
              while ($hari = mysqli_fetch_assoc($hariResult)) :
              ?>
                <!-- Card untuk setiap hari -->
                <div class="bg-white rounded-xl shadow-md p-6">
                  <div class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
                    <?= $hari['nama_hari']; ?>
                  </div>
                  <ul class="mt-4 space-y-2">
                    <?php
                    // Ambil jadwal berdasarkan hari
                    $id_hari = $hari['id_hari'];
                    $result = getJadwalByHari($conn, $id_hari);

                    // Tampilkan setiap mata pelajaran
                    while ($data = mysqli_fetch_assoc($result)) :
                    ?>
                      <li class="flex justify-between items-center">
                        <span class="text-gray-900 font-medium"><?= $data['jam_awal'] . ' - ' . $data['jam_akhir']; ?></span>
                        <span class="text-gray-900 font-medium"><?= $data['nama_mapel']; ?></span>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                </div>
              <?php endwhile; ?>
            </div>
    </div>
  </div>

  <div id="piket" class="container mx-auto mt-10">
    <h3
      class="text-center md:text-2xl lg:text-2xl xl:text-4xl text-lg text-gray-700 font-jkt font-bold">
      Jadwal Piket
    </h3>
    <p class="text-center font-jkt">
      ini jadwal Piket <strike>kita</strike> kami, dan
      <b>hari Sabtu & Minggu </b> adalah hari yang paling menyenangkan
    </p>
  </div>
  <div class="container mx-auto">
    <div class="bg-white mt-5 p-6 rounded-lg shadow-lg">
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Senin -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <div
            class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
            Senin
          </div>
          <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Nina</span>
              <span class="text-gray-900 font-medium">Cahya</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Alia</span>
              <span class="text-gray-900 font-medium">Iki</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Bayu</span>
              <span class="text-gray-900 font-medium">Billy</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Rehan</span>
            </li>
          </ul>
        </div>
        <!-- Selasa -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <div
            class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
            Selasa
          </div>
          <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Mala</span>
              <span class="text-gray-900 font-medium">Meilani</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Nia</span>
              <span class="text-gray-900 font-medium">Malik</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Aryo</span>
              <span class="text-gray-900 font-medium">Marsel</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Hilmy</span>
            </li>
          </ul>
        </div>
        <!-- Rabu -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <div
            class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
            Rabu
          </div>
          <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Chlsea</span>
              <span class="text-gray-900 font-medium">Avril</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Zahra</span>
              <span class="text-gray-900 font-medium">Relly</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Raihan</span>
              <span class="text-gray-900 font-medium">Bagas</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Ramdan</span>
            </li>
          </ul>
        </div>
        <!-- Kamis -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <div
            class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
            Kamis
          </div>
          <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Ollvya</span>
              <span class="text-gray-900 font-medium">Rahma</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Febby</span>
              <span class="text-gray-900 font-medium">Raka</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Farel</span>
              <span class="text-gray-900 font-medium">Wahyu</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Danendra</span>
            </li>
          </ul>
        </div>
        <!-- Jumat -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <div
            class="uppercase tracking-wide text-sm text-indigo-500 font-bold">
            Jumat
          </div>
          <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Mutiara</span>
              <span class="text-gray-900 font-medium">Lulu</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Lela</span>
              <span class="text-gray-900 font-medium">Deka</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Afdal</span>
              <span class="text-gray-900 font-medium">Fitran</span>
            </li>
            <li class="flex justify-between items-center">
              <span class="text-gray-900 font-medium">Nauval</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div id="gallery" class="container mx-auto mt-10">
    <h3
      class="text-center md:text-2xl lg:text-2xl xl:text-4xl text-lg text-gray-700 font-jkt font-bold">
      Gallery Foto Random
    </h3>
    <p class="text-center font-jkt mt-1">
      berikut foto random Kelas <strike>kita</strike> kami cekidot geys...
    </p>
  </div>

  <!-- Gallery -->
  <div class="container mx-auto pb-5">
    <div class="bg-white mt-5 p-6 rounded-lg shadow-lg">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <?php
            $sql = "SELECT * FROM gallery_1 ORDER BY created_at DESC";
            $query = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($query)):
            ?>
        <div
          class="bg-black aspect-[3/4] place-self-auto md:aspect-square bg-[url('upload/<?= $data["image_path"] ?>')] bg-cover bg-center rounded-lg">
        </div>
          <?php endwhile; ?>
        <div
          class="carousel bg-black aspect-[3/4] place-self-auto md:aspect-square bg-cover bg-center rounded-lg col-span-2 md:col-start-3 md:row-start-1 md:row-span-2 md:col-span-2">
          <div class="carousel-item">
            <img
              src="./src/assets/images/all.jpeg"
              class="w-ful rounded-lg"
              alt="Kunjungan Industri ke Kampus ITDA" />
          </div>
          <div class="carousel-item">
            <img
              src="./src/assets/images/a1.jpeg"
              class="w-full rounded-lg"
              alt="Tailwind CSS Carousel component" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Gallery -->

  <!-- component -->
  <footer class="bg-white">
    <div class="container px-6 py-8 mx-auto">
      <div class="flex flex-col items-center text-center">
        <a href="https://www.instagram.com/tpu.nesakti">
          <img class="w-auto h-10" src="./src/assets/logo.png" alt="" />
        </a>

        <p class="max-w-md mx-auto mt-4 font-bold text-black">
          TEKNIK PESAWAT UDARA
        </p>
        <p class="max-w-md mx-auto text-slate-800">
          "Satu Korsa, Satu Rasa, Satu Teknik Pesawat Udara".
        </p>

        <div
          class="flex flex-col mt-4 sm:flex-row sm:items-center sm:justify-center">
          <!-- <button
              class="flex items-center justify-center order-1 w-full px-2 py-2 mt-3 text-sm tracking-wide text-gray-600 capitalize transition-colors duration-300 transform border rounded-md sm:mx-2 dark:border-gray-400 dark:text-gray-300 sm:mt-0 sm:w-auto hover:bg-gray-50 focus:outline-none focus:ring dark:hover:bg-gray-800 focus:ring-gray-300 focus:ring-opacity-40"
            >
              <svg
                class="w-5 h-5 mx-1"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM4 12.172C4.04732 16.5732 7.64111 20.1095 12.0425 20.086C16.444 20.0622 19.9995 16.4875 19.9995 12.086C19.9995 7.68451 16.444 4.10977 12.0425 4.086C7.64111 4.06246 4.04732 7.59876 4 12V12.172ZM10 16.5V7.5L16 12L10 16.5Z"
                  fill="currentColor"
                ></path>
              </svg>

              <span class="mx-1">View Demo</span>
            </button> -->

          <a
            href="https://www.instagram.com/airframe12__"
            class="flex items-center justify-center order-1 w-full px-2 py-2 mt-3 text-sm tracking-wide text-gray-600 transition-colors duration-300 transform border rounded-md sm:mx-2 sm:mt-0 sm:w-auto hover:bg-gray-50 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">@airframe12_</a>

          <a
            href="https://www.instagram.com/tpu.nesakti"
            class="w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-300 transform bg-blue-600 rounded-md sm:mx-2 sm:order-2 sm:w-auto hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
            @tpu.nesakti
          </a>
        </div>
      </div>

      <hr class="my-10 border-gray-200 dark:border-gray-700" />

      <div class="flex flex-col items-center sm:flex-row sm:justify-between">
        <p class="text-sm text-gray-500">
          © Copyright 2021. All Rights Reserved.
        </p>

        <div class="flex mt-3 -mx-2 sm:mt-0">
          <a
            href="#"
            class="mx-2 text-sm text-gray-500 transition-colors duration-300 hover:text-gray-500 dark:hover:text-gray-300"
            aria-label="Reddit">
            Teams
          </a>

          <a
            href="#"
            class="mx-2 text-sm text-gray-500 transition-colors duration-300 hover:text-gray-500 dark:hover:text-gray-300"
            aria-label="Reddit">
            Privacy
          </a>

          <a
            href="https://www.instagram.com/mhmdkhrzmi"
            class="mx-2 text-sm text-gray-500 transition-colors duration-300 hover:text-gray-500 dark:hover:text-gray-300"
            aria-label="Reddit">
            Author
          </a>
        </div>
      </div>
    </div>
  </footer>

  <script src="./src/js/index.js"></script>
  <script>
    // let getTombol = document.getElementById("tombol");

    // window.addEventListener("scroll", function () {
    //   if (
    //     document.body.scrollTop > 20 ||
    //     document.documentElement.scrollTop > 20
    //   ) {
    //     getTombol.style.display = "block";
    //   } else {
    //     getTombol.style.display = "none";
    //   }
    // });

    // getTombol.addEventListener("click", function () {
    //   document.body.scrollTop = 0;
    //   document.documentElement.scrollTop = 0;
    // });
  </script>
</body>

</html>
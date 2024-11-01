<nav class="absolute mx-auto px-2 mt-5 flex w-full h-16 z-20">
  <div
    class="container py-2 flex flex-row justify-center self-center backdrop-blur bg-white/30 rounded-2xl">
    <div class="flex-1">
      <!-- <a class="btn btn-ghost text-xl text-jkt">X TPU</a> -->
      <?php
      $sql = "SELECT title FROM banner LIMIT 1";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if ($row) {
        echo '<a class="btn btn-ghost text-xl text-jkt">' . $row["title"] . '</a>';
      } else {
        echo "";
      }
      ?>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1 text-black">
        <li><a href="#">Home</a></li>
        <li>
          <details>
            <summary>Menu</summary>
            <ul class="p-2 backdrop-blur bg-white/30 rounded-t-none">
              <li><a href="#struktur">Struktur</a></li>
              <li><a href="#mapel">Mapel</a></li>
              <li><a href="#piket">Piket</a></li>
              <li><a href="#gallery">Gallery</a></li>
              <li><a href="#anggota">Anggota</a></li>
              <li><a href="admin/index.php">Login</a></li>
            </ul>
          </details>
        </li>
      </ul>
    </div>
  </div>
</nav>
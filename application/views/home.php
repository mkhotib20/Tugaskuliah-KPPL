  <div class="content-wrapper">
    <section class="content-header">
    <?php echo $this->session->flashdata('pesan'); ?>
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <h3>
        Selamat Datang Administrator, anda memiliki hak akses sebagai adminstarator. Dan memiliki hak akses sebagai berikut :
      </h3>
      <br>
      <h4>
        <ol>
          <li>Mencatat Semua data peminjaman (<a href="halamanPeminjaman/peminjaman">Halaman Peminjaman</a>) </li>
          <li>Mencatat dan memperbaharui data Mobil (<a href="halamanMobil/mobil">Halaman Mobil</a>) </li>
          <li>Mencatat dan memperbaharui data Supir (<a href="halamanSupir/supir">Halaman Supir</a>) </li>
        </ol>
      </h4>
    </section>
  </div>
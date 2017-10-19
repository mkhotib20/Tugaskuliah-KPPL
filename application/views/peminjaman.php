  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Peminjaman
        <small>Pencatatan segala peminjaman mobil</small>
      </h1>
      <br>
     <div class="row">
      <div class="col-md-3">
         <a class="btn btn-success" href="<?php echo base_url('home/inputPeminjaman') ?>">Tambah Mobil</a>
       </div>
     </div>
       <br>
       <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Peminjaman Mobil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover ">
                <thead>
                  <tr>
                    <th style="text-align: center;">Nama Peminjam</th>
                    <th style="text-align: center;">KTP Peminjam</th>
                    <th style="text-align: center;">Nama Supir</th>
                    <th style="width: 100px; text-align: center;">Mobil Yang Dipinjam</th>
                    <th style="width: 100px; text-align: center;">Tanggal Kembali</th>
                    <th style="width: 150px; text-align: center;">Kekurangan</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($tampil as $t) { ?>
                  <tr>
                    <td><?php echo $t['nama_peminjam'] ?></td>
                    <td><?php echo $t['no_ktp_peminjam'] ?></td>
                    <td><?php echo $t['nama_supir'] ?></td>
                    <td><?php echo $t['merk'] ?></td>
                    <td style="text-align: center;" ><?php echo $t['tgl_kembali'] ?></td>
                    <td style="text-align: right;"><?php 
                        $dp = $t['uang_muka'];
                        $total = $t['biaya_total'];
                        $kekurangan = $total - $dp;
                        if ($kekurangan>0) {
                           echo 'Rp. '.number_format($kekurangan, 2, ',', '.');
                         } 
                         else{
                          echo 'Lunas';
                         }
                    ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>

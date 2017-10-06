  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Mobil
        <small>Pencatatan data mobil</small>
      </h1>
      <br>
     <div class="row">
       <div class="col-md-3">
          <div class="input-group input-group-sm">
            <input type="text" placeholder="Cari Kode" class="form-control">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-flat">Go!</button>
            </span>
          </div>
       </div>
       <div class="col-md-3">
         <a class="btn btn-success" href="<?php echo base_url('home/inputMobil') ?>">Tambah Mobil</a>
       </div>
     </div>
     <br>
     <?php echo $this->session->flashdata('pesan') ?>
       <br>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover ">
                <thead>
                  <tr>
                    <th style="text-align: center;">No Polisi</th>
                    <th style="text-align: center;">Merk Mobil</th>
                    <th style="text-align: center;">Tarif Mobil</th>
                    <th style="text-align: center;">Status Mobil</th>
                    <th style="width: 100px; text-align: center;">Gambar Mobil</th>
                    <th style="text-align: center;">Edit Informasi</th>
                    <th style="text-align: center;">Hapus Mobil</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($tampil as $t) { ?>
                  <tr>
                    <td><?php echo $t['no_polisi'] ?></td>
                    <td><?php echo $t['merk'] ?></td>
                    <td><?php echo $t['harga'] ?></td>
                    <td><?php echo $t['status'] ?></td>
                    <td><img style="width: 350px" src="<?php echo $t['gambar'] ?>"></td>
                    <td style="text-align: center" ><a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td style="text-align: center" ><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
          <br>
    </section>
  </div>

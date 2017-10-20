  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Mobil
        <small>Pencatatan data mobil</small>
      </h1>
      <br>
     <div class="row">
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
                    <th style="width: 100px; text-align: center;">Status Mobil</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($tampil as $t) { ?>
                  <tr>
                    <td><?php echo $t['no_polisi'] ?></td>
                    <td><?php echo $t['merk'] ?></td>
                    <td><?php echo 'Rp. '.number_format( $t['harga'], 2, ',', '.') ?></td>
                    <td><?php echo $t['status'] ?></td>
                    <td><img style="width: 350px" src="<?php echo $t['gambar'] ?>"></td>
                    <td style="text-align: center" >
                      <?php 
                        if ($t['status']==1) {
                          echo '<span class="btn btn-success glyphicon glyphicon-ok"></span>';
                        }
                        else{
                          echo '<span class="btn btn-danger glyphicon glyphicon-ban-circle"></span>';
                        } 
                      ?>
                    </td>
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

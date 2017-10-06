  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Supir
        <small>Pencatatan data Supir</small>
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
         <a class="btn btn-success" href="<?php echo base_url('home/inputSupir') ?>">Tambah Supir</a>
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
                    <th style="text-align: center;">No KTP</th>
                    <th style="text-align: center;">Nama Supir</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">Nomor HP</th>
                    <th style="text-align: center;">No SIM</th>
                    <th style="width: 100px; text-align: center;">Foto</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Edit</th>
                    <th style="text-align: center;">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($tampil as $t) { ?>
                  <tr>
                    <td><?php echo $t['no_ktp'] ?></td>
                    <td><?php echo $t['nama_supir'] ?></td>
                    <td><?php echo $t['alamat'] ?></td>
                    <td><?php echo $t['no_hp'] ?></td>
                    <td><?php echo $t['no_sim'] ?></td>
                    <td><img style="width: 300px" src="<?php echo $t['foto'] ?>"></td>
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

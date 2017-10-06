  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Peminjaman
        <small>Pencatatan segala peminjaman mobil</small>
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
     </div>
       <br>
       <div class="row">
        <div class="col-md-3">
           <a href="<?php echo base_url('home/inputPeminjaman') ?>">
             <div class="box-form box-blue">
             <p class="box-text plus">+</p>
           </div>
           </a>
        </div>
        <?php foreach ($tampil as $t) {?>
        <div class="col-md-3">
           <a href="#">
             <div class="box-form <?php 
                if ($t['status']==1) {
                  echo 'box-green';
                }
                else{
                 echo 'box-yellow' ;
                }
              ?>">
             <p class="box-text"><?php echo$t['kode_pinjam'] ?> <br> <?php echo $t['no_ktp_pjm'] ?></p>
           </div>
           </a>
        </div>
        <?php } ?>
      </div>
    </section>
  </div>

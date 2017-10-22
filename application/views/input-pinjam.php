  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <div class="content-wrapper">
    <section class="content-header">
      <h1 style="margin-bottom: 70px">
        Data Peminjaman
        <small>Pencatatan segala peminjaman mobil</small>
        <?php echo $this->session->flashdata('pesan') ?>
      </h1>
      <div class="row">
          <?php echo form_open('halamanPeminjaman/prosesPinjam') ?>
        <div class="col-md-6">
            <p><input type="text" class="form-control" readonly="" value="<?php echo $kode ?>" name="kodePeminjaman"></p>
            <p>
              <select name="mobil" class="form-control">
                <option selected="" disabled="">--pilih mobil--</option>
                <?php foreach ($tampilM as $mobil) { ?>
                <option <?php 
                    if ($mobil['status']==0) {
                      echo 'disabled=""';
                    }
                 ?> ><?php echo $mobil['merk'] ?></option>
                <?php } ?>                
              </select>
            </p>
            <p>
              <select name="supir" class="form-control">
                <option selected="" disabled="">--pilih supir, abaikan jika tidak--</option>
                <?php foreach ($tampilS as $supir) { ?>
                <option <?php 
                    if ($supir['status']==0) {
                      echo 'disabled=""';
                    }
                 ?> ><?php echo $supir['nama_supir'] ?></option>
                <?php } ?>
              </select>
            </p>
            <p><input type="text" class="form-control" placeholder="Nama Peminjam" name="namaPeminjam"></p>
            <p><input type="text" class="form-control" placeholder="KTP Peminjam" name="ktpPeminjam"></p>
            <p><input type="text" class="form-control" placeholder="Alamat Lengkap" name="alamatPeminjam"></p>
            <p><input type="text" class="form-control" placeholder="Nomor HP" name="hpPeminjam"></p>
            <p><input type="text" class="form-control" placeholder="Uang Muka" name="uangMuka"></p>
          
        </div>
        <div class="col-md-6">
          <p><textarea class="form-control" name="kondisiKendaraan" placeholder="Kondisi Kendaraan"></textarea></p>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="date" name="tglBalik" class="form-control" id="datepicker">
          </div>
          <br>
          <p><input type="submit" class="btn btn-green pull-right" value="Simpan"></p>
        </div>
          </form>
      </div>
      <br>
    </section>
  </div>

  <div class="content-wrapper">
    <section class="content-header">
      <h1 style="margin-bottom: 70px">
        Data Supir
        <small>Pencatatan data Supir</small>
      </h1>
      <div class="row">
          <?php echo form_open_multipart('Home/prosesSupir') ?>
        <div class="col-md-4">
          <p><input type="text" class="form-control" placeholder="Nomor KTP" name="noKTP"></p>
          <p><input type="text" class="form-control" placeholder="Nama Supir" name="namaSupir"></p>
          <p><input type="text" class="form-control" placeholder="Alamat Supir" name="alamatSupir"></p>
          <p><input type="text" class="form-control" placeholder="Nomor HP" name="noHP"></p>
          <p><input type="text" class="form-control" placeholder="Nomor SIM" name="noSIM"></p>
          <p><input type="file" onchange="readURL(this);"  name="gambarSupir" class="form-control"></p>
          <p><input type="submit" class="btn btn-green pull-right" value="Simpan"></p>  
        </div>
          </form>
        <div class="col-md-4">
          <img id="preview_gambar" alt="Gambar Anda" />
        </div>
      </div>
      <br>
    </section>
  </div>
<script>
    function readURL(input) { // Mulai membaca inputan gambar
    if (input.files && input.files[0]) {
    var reader = new FileReader(); // Membuat variabel reader untuk API FileReader
     
    reader.onload = function (e) { // Mulai pembacaan file
    $('#preview_gambar') // Tampilkan gambar yang dibaca ke area id #preview_gambar
    .attr('src', e.target.result)
    .width(600); // Menentukan lebar gambar preview (dalam pixel)
    //.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
    };
     
    reader.readAsDataURL(input.files[0]);
    }
    }
  </script>

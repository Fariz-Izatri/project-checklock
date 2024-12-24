<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
  <div class="card-body">
    <form method="POST" action="<?= base_url('pegawai/ketidakhadiran/store')?>" enctype="multipart/form-data">

      <?= csrf_field() ?>

      <input type="hidden" value="<?= session()->get('id_pegawai')?>" name="id_pegawai" >

      <div class="input-style-1">
      <label>Keterangan</label>
      <select name="keterangan" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>">
        <option value="">--pilih Keterangan--</option>
        <option value="izin">izin</option>
        <option value="sakit">sakit</option>
      </select>
      <div class="invalid-feedback"><?= $validation->getError('keterangan')?></div>
      </div>

      <div class="input-style-1">
      <label>Tanggal ketidakhadiran</label>
      <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" name="tanggal" value="<? set_value('tanggal')?>"/>
      <div class="invalid-feedback"><?= $validation->getError('tanggal')?></div>
      </div>


      <div class="input-style-1">
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Deskripsi"></textarea>
      <div class="invalid-feedback"><?= $validation->getError('deskripsi')?></div>
      </div>

      <div class="input-style-1">
      <label>File</label>
      <input type="file" class="form-control <?= ($validation->hasError('file')) ? 'is-invalid' : '' ?>" name="file" />
      <div class="invalid-feedback"><?= $validation->getError('file')?></div>
      </div>

      

      <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
  </div>
</div>

    
<?= $this->endSection() ?>
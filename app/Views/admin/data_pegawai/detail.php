<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-8">
  <div class="card-body">
    <img style="border-radius: 10px" width="120px" src="<?= base_url('profile/'.$pegawai['foto'])?>" alt="">
    <table class="table">
      <tr>
        <td>NIP</td>
        <td>:</td>
        <td><?= $pegawai['nip'] ?></td>        
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $pegawai['nama'] ?></td>
      </tr>
      <tr>
        <td>Username</td>
        <td>:</td>
        <td><?= $pegawai['username'] ?></td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?= $pegawai['jenis_kelamin'] ?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= $pegawai['alamat'] ?></td>
      </tr>
      <tr>
        <td>No. Handphone</td>
        <td>:</td>
        <td><?= $pegawai['no_handphone'] ?></td>
      </tr>
      <tr>
        <td>jabatan</td>
        <td>:</td>
        <td><?= $pegawai['jabatan'] ?></td>
      </tr>
      <tr>
        <td>Lokasi Presensi</td>
        <td>:</td>
        <td><?= $pegawai['lokasi_presensi'] ?></td>
      </tr>
      <tr>
        <td>status</td>
        <td>:</td>
        <td><?= $pegawai['status'] ?></td>
      </tr>
      <tr>
        <td>role</td>
        <td>:</td>
        <td><?= $pegawai['role'] ?></td>
      </tr>
    </table>
  </div>
</div>
    
<?= $this->endSection() ?>
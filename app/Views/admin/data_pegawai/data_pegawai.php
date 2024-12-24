<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/data_pegawai/create')?>" class="btn btn-primary">Add Data</a>

<table class="table table-striped" id="datatables">
  <thead>
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Lokasi Presensi</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody> 
  <?php $no = 1;
   foreach($pegawai as $peg) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $peg['nip'] ?></td>
        <td><?= $peg['nama'] ?></td>
        <td><?= $peg['jabatan'] ?></td>
        <td><?= $peg['lokasi_presensi'] ?></td>
        <td>
          <a href="<?= base_url('admin/data_pegawai/detail/' .$peg['id'])?>" class="badge bg-primary">Detail </a>

          <a href="<?= base_url('admin/data_pegawai/edit/' .$peg['id'])?>" class="badge bg-primary">Edit </a>
          <a href="<?= base_url('admin/data_pegawai/delete/' .$peg['id'])?>" class="badge bg-danger tombol-hapus">Delete</a>
        </td>
      </tr>
      <?php endforeach?>
  </tbody>
</table>
    
<?= $this->endSection() ?>
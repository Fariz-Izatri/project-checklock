<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('pegawai/ketidakhadiran/create')?>" class="btn btn-primary">Ajukan</a>

<table class="table table-striped" id="datatables">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
      <th>Deskripsi</th>
      <th>file</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>

  <?php if($ketidakhadiran) :?>
  <tbody> 
  <?php $no = 1;
   foreach($ketidakhadiran as $ketidakhadiran) : ?>

      <tr>
        <td><?= $no++ ?></td>
        <td><?= $ketidakhadiran['tanggal'] ?></td>
        <td><?= $ketidakhadiran['keterangan'] ?></td>
        <td><?= $ketidakhadiran['deskripsi'] ?></td>
        <td>
          <a class="badge bg-primary" href="<?= base_url('file_ketidakhadiran/'.$ketidakhadiran['file'])?>">Download</a>
        </td>
        <td><?= $ketidakhadiran['status'] ?></td>
        <td>

          <a href="<?= base_url('pegawai/ketidakhadiran/edit/' .$ketidakhadiran['id'])?>" class="badge bg-primary">Edit </a>
          <a href="<?= base_url('pegawai/ketidakhadiran/delete/' .$ketidakhadiran['id'])?>" class="badge bg-danger tombol-hapus">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
  </tbody>
  <?php else :?>
    <tbody>
      <tr>
        <td colspan="7">Data masih kosong</td>
      </tr>
    </tbody>
  <?php endif;?>
</table>
    
<?= $this->endSection() ?>
<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/jabatan/create')?>" class="btn btn-primary">Add Data</a>

<table class="table table-striped" id="datatables">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Jabatan</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody> 
  <?php $no = 1;
   foreach($jabatan as $jab) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $jab['jabatan'] ?></td>
        <td>
          <a href="<?= base_url('admin/jabatan/edit/' .$jab['id'])?>" class="badge bg-primary">Edit Data</a>
          <a href="<?= base_url('admin/jabatan/delete/' .$jab['id'])?>" class="badge bg-danger tombol-hapus">Delete Data</a>
        </td>
      </tr>
      <?php endforeach?>
  </tbody>
</table>
    
<?= $this->endSection() ?>
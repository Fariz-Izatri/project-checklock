<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/jabatan/create')?>" class="btn btn-primary">Add Data</a>

<table class="table" id="datatables">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Jabatan</th>
      <th>Action</th>
    </tr>
  </thead>

  <?php $no = 1;
   foreach($jabatan as $jab) : ?>
    <tbody>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $jab['jabatan'] ?></td>
        <td>
          <a href="<?= base_url('admin/jabatan/update/' .$jab['id'])?>" class="btn btn-primary">Edit Data</a>
          <a href="<?= base_url('admin/jabatan/delete/' .$jab['id'])?>" class="btn btn-danger">Delete Data</a>
        </td>
      </tr>
    </tbody>
    <?php endforeach?>
</table>
    
<?= $this->endSection() ?>
<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>


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
          <td>
            <?php if($ketidakhadiran['status'] == 'Pending') :?>
              <span class="text-danget"><?= $ketidakhadiran['status'] ?></span>
            <?php else :?>
              <span class="text-success"><?= $ketidakhadiran['status'] ?></span>
              <?php endif;?>
          </td>
            
        <td>
          <a class="badge bg-success" href="<?= base_url('admin/approved_ketidakhadiran/'.$ketidakhadiran['id'])?>">Approved</a>
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
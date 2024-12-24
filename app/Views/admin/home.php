<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<?php date_default_timezone_set('Asia/Jakarta');?>
<span class="mb-3">Data Tangal <?= date('d F Y')?></span>
<div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon purple">
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">Total Pegawai</h6>
          <h3 class="text-bold mb-10"><?= $total_pegawai?></h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon success">
          <i class="fa-regular fa-circle-check"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">Hadir</h6>
          <h3 class="text-bold mb-10"><?= $total_hadir?></h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon primary">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">Alpha</h6>
          <h3 class="text-bold mb-10"><?= $total_pegawai-$ketidakhadiran?></h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon orange">
          <i class="fa-regular fa-face-frown-open"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">izin/sakit/cuti</h6>
          <h3 class="text-bold mb-10"><?= $ketidakhadiran?></h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
</div>

<?= $this->endSection() ?>
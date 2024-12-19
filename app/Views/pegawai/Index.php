<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pegawai</h4>
                <a href="<?= base_url('pegawai/create') ?>" class="btn btn-primary">Tambah Pegawai</a>
            </div>
            <div class="card-body">
                <div class="table-responsive"> <!-- Menambahkan kelas table-responsive untuk membuat tabel bisa digulir horizontal -->
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>No Handphone</th>
                                <th>Jabatan</th>
                                <th>Lokasi Presensi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pegawai as $pegawai): ?>
                            <tr>
                                <td><?= $pegawai['id'] ?></td>
                                <td><?= $pegawai['nip'] ?></td>
                                <td><?= $pegawai['nama'] ?></td>
                                <td><?= $pegawai['jenis_kelamin'] ?></td>
                                <td><?= $pegawai['alamat'] ?></td>
                                <td><?= $pegawai['no_handphone'] ?></td>
                                <td><?= $pegawai['jabatan'] ?></td>
                                <td><?= $pegawai['lokasi_presensi'] ?></td>
                                <td>
                                    <a href="<?= base_url('pegawai/edit/'.$pegawai['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url('pegawai/delete/'.$pegawai['id']) ?>" method="POST" style="display:inline-block;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

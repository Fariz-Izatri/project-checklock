<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Pegawai</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pegawai/update/'.$pegawai['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" value="<?= old('nip', $pegawai['nip']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', $pegawai['nama']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="L" <?= old('jenis_kelamin', $pegawai['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= old('jenis_kelamin', $pegawai['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?= old('alamat', $pegawai['alamat']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_handphone">No Handphone</label>
                        <input type="text" id="no_handphone" name="no_handphone" class="form-control" value="<?= old('no_handphone', $pegawai['no_handphone']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= old('jabatan', $pegawai['jabatan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_presensi">Lokasi Presensi</label>
                        <input type="text" id="lokasi_presensi" name="lokasi_presensi" class="form-control" value="<?= old('lokasi_presensi', $pegawai['lokasi_presensi']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

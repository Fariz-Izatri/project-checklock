<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'pegawai';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nip', 'nama', 'jenis_kelamin', 'alamat', 'no_handphone', 'jabatan', 'lokasi_presensi', 'foto'];

    // Validasi
    protected $validationRules    = [
        'nip'            => 'required|is_unique[pegawai.nip]',
        'nama'           => 'required',
        'jenis_kelamin'  => 'required',
        'alamat'         => 'required',
        'no_handphone'   => 'required',
        'jabatan'        => 'required',
        'lokasi_presensi' => 'required',
        'foto'           => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

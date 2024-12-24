<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\KetidakhadiranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ketidakhadiran extends BaseController
{
    function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $id_pegawai = session()->get('id_pegawai');
        $data = [
            'title' => 'Ketidakhadiran',
            'ketidakhadiran' => $ketidakhadiranModel->where('id_pegawai', $id_pegawai)->findAll()
        ];
        return view('pegawai/ketidakhadiran', $data);
    }

    public function create(){

        $data = [
            'title' => 'Ajukan Ketidakhadiran',
            'validation' => \Config\Services::validation()
        ];
        return view('pegawai/create_ketidakhadiran', $data);
    }

    public function store(){
        $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'keterangan harus diisi'
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal harus diisi'
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi harus diisi'
                ],
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'File harus diupload',
                    'max_size' => 'Ukuran file terlalu besar',
                    'mime_in' => 'Yang anda pilih bukan PNG,JPG, atau PDF'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            $data = [
                'title' => 'Ajukan Ketidakhadiran',
                'validation' => \Config\Services::validation()
            ];
            return view('pegawai/create_ketidakhadiran', $data);
        } else {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $file = $this->request->getFile('file');

            if($file->getError() == 4){
                $nama_file = '';
            } else {
                $nama_file = $file->getRandomName();
                $file->move('file_ketidakhadiran', $nama_file);
            }

            $ketidakhadiranModel->insert([
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,

            ]);

            session()->setFlashdata('berhasil', 'Ketidakhadiran berhasil diajukan');

            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        }
    }

    public function edit($id){
        $ketidakhadiranModel = new KetidakhadiranModel();
        $data = [
            'title' => 'Edit Ketidakhadiran',
            'ketidakhadiran' => $ketidakhadiranModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pegawai/edit_ketidakhadiran', $data);
    }

    public function update($id){
        $ketidakhadiranModel = new KetidakhadiranModel();
        $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'keterangan harus diisi'
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal harus diisi'
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi harus diisi'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            $ketidakhadiranModel = new KetidakhadiranModel();
        $data = [
            'title' => 'Edit Ketidakhadiran',
            'ketidakhadiran' => $ketidakhadiranModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pegawai/edit_ketidakhadiran', $data);
        } else {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $file = $this->request->getFile('file');

            if($file->getError() == 4){
                $nama_file = $this->request->getPost('file_lama');
            } else {
                $nama_file = $file->getRandomName();
                $file->move('file_ketidakhadiran', $nama_file);
            }

            $ketidakhadiranModel->update($id, [
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,

            ]);
            
            session()->setFlashdata('berhasil', 'Data ketidakhadiran berhasil diupdate');

            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        }
    }

    function delete($id){
        $ketidakhadiranModel = new KetidakhadiranModel();
        $ketidakhadiran = $ketidakhadiranModel->find($id);
        if($ketidakhadiran){
            $ketidakhadiranModel->where('id_pegawai', $id)->delete();
            $ketidakhadiranModel->delete($id);
            session()->setFlashdata('berhasil', 'Data ketidakhadiran berhasil dihapus');
            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        } 
    }
}

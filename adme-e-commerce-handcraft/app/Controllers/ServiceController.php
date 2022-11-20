<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JasaModel;

class ServiceController extends BaseController
{
    public function __construct()
    {
        $this->jasaModel = new JasaModel();
    }
    public function index()
    {
        $data = $this->jasaModel->get()->getResult();
        return view('merchant/service', compact('data'));
    }
    public function save(){
        try {
            $data = $this->request->getVar();
            $file = $this->request->getFile('file');
            $rules = [
                'nama_jasa' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Nama Jasa Harus diisi'
                        ]
                    ],
                'deskripsi' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Deskripsi Harus diisi'
                        ]
                ],
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            $nama_file = $file->getRandomName();
            $insert = [
                "nama_jasa" => $data['nama_jasa'],
                "foto" => $nama_file,
                "deskripsi" => $data["deskripsi"],
                "slug" => "service-detail/" . str_replace(' ', '-', strtolower($data['nama_jasa'])) .'-'. generateRandomString(10)
            ];
            $this->jasaModel->insert($insert);
            $file->move('assets/img/jasa/', $nama_file);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $file = $this->request->getFile('file');
            $rules = [
                'nama_jasa' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Nama Jasa Harus diisi'
                        ]
                    ],
                'deskripsi' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Deskripsi Harus diisi'
                        ]
                ],
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            $nama_file = $file->getRandomName();
            $update = [
                "nama_jasa" => $data['nama_jasa'],
                "deskripsi" => $data["deskripsi"],
                "slug" => "service-detail/" . str_replace(' ', '-', strtolower($data['nama_jasa'])) .'-'. generateRandomString(10)
            ];

            if($file->getFilename()){
                $update['foto'] = $nama_file;
                $file->move('assets/img/jasa/', $nama_file);
            }

            $this->jasaModel->update($data['id_jasa'], $update);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th){
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->jasaModel->delete($data['id_jasa']);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}

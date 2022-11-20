<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = $this->produkModel->get()->getResult();
        return view('merchant/product', compact('data'));
    }
    
    public function save(){
        try {
            $data = $this->request->getVar();
            $file = $this->request->getFile('file');
            $rules = [
                'id_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Kategori Produk Harus diisi'
                    ]
                ],
                'nama_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Nama Produk Harus diisi'
                        ]
                    ],
                    'jumlah_produk_satuan' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Jumlah Produk Satuan Harus diisi'
                    ]
                ],
                'harga' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Harga Harus diisi'
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
                "id_jenis_produk" => $data['id_jenis_produk'],
                "nama_produk" => $data['nama_produk'],
                "jumlah_produk_satuan" => $data["jumlah_produk_satuan"],
                "harga" => $data["harga"],
                "foto" => $nama_file,
                "deskripsi" => $data["deskripsi"],
                "slug" => "product-detail/" . str_replace(' ', '-', strtolower($data['nama_produk'])) .'-'. generateRandomString(10)
            ];
            $this->produkModel->insert($insert);
            $file->move('assets/img/produk/', $nama_file);
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
                'id_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Kategori Produk Harus diisi'
                    ]
                ],
                'nama_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Nama Produk Harus diisi'
                        ]
                    ],
                    'jumlah_produk_satuan' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Jumlah Produk Satuan Harus diisi'
                    ]
                ],
                'harga' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Harga Harus diisi'
                        ]
                    ],
                    'deskripsi' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Deskripsi Harus diisi'
                    ]
                ],
                'file' => [
                    'rules' => 'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
                    'errors' => [
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
                "id_jenis_produk" => $data['id_jenis_produk'],
                "nama_produk" => $data['nama_produk'],
                "jumlah_produk_satuan" => $data["jumlah_produk_satuan"],
                "harga" => $data["harga"],
                "deskripsi" => $data["deskripsi"],
                "slug" => "product-detail/" . str_replace(' ', '-', strtolower($data['nama_produk'])) .'-'. generateRandomString(10)
            ];

            if($file->getFilename()){
                $update['foto'] = $nama_file;
                $file->move('assets/img/produk/', $nama_file);
            }

            $this->produkModel->update($data['id_produk'], $update);
            
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_produk');
            $this->produkModel->where('id_produk', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}

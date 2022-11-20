<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {
        $data = $this->kategoriModel->get()->getResult();
        return view('merchant/category', compact('data'));
    }

    public function save(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'kode_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('merchant/category',[
                    'validation' => $this->validator
                ]);
            }else{
                $this->kategoriModel->insert($data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_jenis_produk');
            $this->kategoriModel->where('id_jenis_produk', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'kode_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_jenis_produk' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('merchant/category',[
                    'validation' => $this->validator
                ]);
            }else{
                $this->kategoriModel->update($data['id_jenis_produk'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}

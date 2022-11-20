<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class MerchantController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        return view('merchant/dashboard');
    }

    public function index(){
        $data = $this->userModel->where('level', 2)
            ->get()->getResult();
        return view('admin/merchant', compact('data'));
    }

    public function save(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'email' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_depan' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_belakang' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'no_hp' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('admin/admin',[
                    'validation' => $this->validator
                ]);
            }else{
                $this->userModel->insert([
                    'email' => $data['email'],
                    'nama_depan' => $data['nama_depan'],
                    'nama_belakang' => $data['nama_belakang'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'no_hp' => $data['no_hp'],
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    'plain_password' => $data['password'],
                    'level' => 2,
                ]);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            var_dump($th);exit;
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'email' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_depan' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_belakang' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'no_hp' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('admin/admin',[
                    'validation' => $this->validator
                ]);
            }else{
                $this->userModel->update($data['id_user'], [
                    'email' => $data['email'],
                    'nama_depan' => $data['nama_depan'],
                    'nama_belakang' => $data['nama_belakang'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'no_hp' => $data['no_hp'],
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    'plain_password' => $data['password'],
                    'level' => 2,
                ]);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            var_dump($th);exit;
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_user');
            $this->userModel->where('id_user', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}

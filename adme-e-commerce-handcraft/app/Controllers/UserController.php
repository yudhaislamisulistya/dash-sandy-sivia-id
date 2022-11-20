<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        if(cekUser() == 3){
            return redirect()->to(base_url('admin/dashboard'));
        }else if(cekUser() == 2){
            return redirect()->to(base_url('merchant/dashboard'));
        }
        return view('login');
    }

    private function setUserSession($user){
        $data = [
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'nama_lengkap' => $user['nama_lengkap'],
            'avatar' => $user['avatar'],
            'no_hp' => $user['no_hp'],
            'level' => $user['level'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url());
    }

    public function login(){
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];

        $errors = [
            'password' => [
                'validateUser' => "Email atau Password Tidak Sama",
            ],
        ];

        if(!$this->validate($rules, $errors)){
            return view('login', [
                'validation' => $this->validator,
            ]);
        } else {
            $user = $this->userModel->where('email', $this->request->getVar('email'))
                ->first();
            
            // Menyimpan Nilai Session
            $this->setUserSession($user);

            // Disini Kondisi Yah
            if($user['level'] == 3){
                return redirect()->to(base_url());
            }else if($user['level'] == 2){
                return redirect()->to(base_url('merchant/dashboard'));
            }else if($user['level'] == 1){
                return redirect()->to(base_url());
            }
        }
    }

    public function list(){
        $data = $this->userModel->where('level', 1)
            ->get()->getResult();
        return view('merchant/user', compact('data'));
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

    public function user(){
        $data = $this->userModel->where('level', 1)
            ->get()->getResult();
        return view('admin/customer', compact('data'));
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
                    'level' => 1,
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
                    'level' => 1,
                ]);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            var_dump($th);exit;
            return redirect()->back()->with('status', 'failed');
        }
    }

    
}

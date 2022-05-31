<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $validation;
    protected $db;

    public function __construct()
    {
        $this->validation =  \Config\Services::validation();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Authentication',
            'active' => 'authentication',
            'js' => 'auth.js'
        ];
        return view('auth/index', $data);
    }

    public function login()
    {
        if ($this->request->isAJAX()) {

            $validasi = $this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username harus di isi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus di isi',
                    ]
                ],
            ]);

            if (!$validasi) {
                $msg = [
                    'error' => [
                        'username' => $this->validation->getError('username'),
                        'password' => $this->validation->getError('password'),
                    ]
                ];
            } else {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $data = $this->db->table('users')->getWhere(['username' => $username])->getRowArray();

                if ($data) {
                    $pass = $data['password'];
                    $verify_pass = password_verify($password, $pass);
                    if ($verify_pass) {
                        $session_data = [
                            'kd_user'       => param_encrypt($data['kd_user']),
                            'nama'     => $data['nama'],
                            'foto' => $data['foto'],
                            'hak_akses'    => $data['hak_akses'],
                            'logged_in'     => TRUE,
                        ];
                        session()->set($session_data);
                        $this->db->table('users')->update(['lasted_login' => date('Y-m-d H:i:s')], ['kd_user' => $data['kd_user']]);
                        $msg = [
                            'status' => 200,
                            'message' => 'Berhasil login!'
                        ];
                    } else {
                        $msg = [
                            'status' => 401,
                            'message' => 'Password anda salah!'
                        ];
                    }
                } else {
                    $msg = [
                        'status' => 401,
                        'message' => 'Username tidak ditemukan!'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function logout()
    {
        if ($this->request->isAjax()) {
            session()->destroy();
            $msg = [
                'status' => 200,
                'message' => 'Berhasil logout!'
            ];
            echo json_encode($msg);
        }
    }
}

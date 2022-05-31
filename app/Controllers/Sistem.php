<?php

namespace App\Controllers;

class Sistem extends BaseController
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
            'title' => 'Manajemen Sistem',
            'active' => 'manajemen_sistem',
            'js' => 'sistem.js',
            'sistem' => $this->db->table('manajemen_sistem')->get()->getFirstRow('array'),
        ];
        return view('sistem/index', $data);
    }

    public function form_edit()
    {
        if ($this->request->isAjax()) {
            $id_sistem = param_decrypt($this->request->getVar('id'));
            $sistem = $this->db->table('manajemen_sistem')->getWhere(['id' => $id_sistem])->getRowArray();
            $data = [
                'sistem' => $sistem,
            ];

            $msg = [
                'message' => view('sistem/modal_edit', $data),
            ];

            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_sistem = param_decrypt($this->request->getVar('id'));
            $sistem = $this->db->table('manajemen_sistem')->getWhere(['id' => $id_sistem])->getRowArray();

            $validasi = $this->validate([
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus di isi'
                    ]
                ],
                'owner' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Owner harus di isi',
                    ]
                ],
                'telpon' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Telpon harus di isi',
                        'numeric' => 'Telpon harus berupa angka'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus di isi',
                        'valid_email' => 'Harus menggunakan email yang valid'
                    ]
                ],
                'running_text' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Running Text harus di isi',
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus di isi',
                    ]
                ],
                'tentang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tentang harus di isi',
                    ]
                ],
                'logo' => [
                    'rules' => 'mime_in[logo,image/png, image/gif]|is_image[logo]|max_size[logo,1060]',
                    'errors' => [
                        'mime_in' => 'File Extention Harus Berupa png/gif',
                        'max_size' => 'Ukuran File Maksimal 1 MB'
                    ]
                ],
            ]);

            if (!$validasi) {
                $msg = [
                    'error' => [
                        'nama' => $this->validation->getError('nama'),
                        'owner' => $this->validation->getError('owner'),
                        'telpon' => $this->validation->getError('telpon'),
                        'email' => $this->validation->getError('email'),
                        'running_text' => $this->validation->getError('running_text'),
                        'alamat' => $this->validation->getError('alamat'),
                        'tentang' => $this->validation->getError('tentang'),
                        'logo' => $this->validation->getError('logo'),
                    ]
                ];
            } else {
                $logo = $this->request->getFile('logo');
                if ($logo->isValid()) {
                    $filename = $logo->getRandomName();
                    @unlink('assets/images/sistem/' . $sistem['logo']);
                    $logo->move('assets/images/sistem', $filename);
                } else {
                    $filename = $sistem['logo'];
                }

                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'owner' => $this->request->getVar('owner'),
                    'telpon' => $this->request->getVar('telpon'),
                    'email' => $this->request->getVar('email'),
                    'alamat' => $this->request->getVar('alamat'),
                    'running_text' => $this->request->getVar('running_text'),
                    'tentang' => $this->request->getVar('tentang'),
                    'logo' => $filename,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->db->table('manajemen_sistem')->update($data, ['id' => $id_sistem]);

                $msg = [
                    'message' =>  'Data berhasil di ubah',
                ];
            }

            echo json_encode($msg);
        }
    }
}

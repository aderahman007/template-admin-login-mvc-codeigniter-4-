<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsersModel;
use Hermawan\DataTables\DataTable;

class Users extends BaseController
{

	protected $usersModel;
	protected $validation;
	protected $db;

	public function __construct()
	{
		$this->usersModel = new UsersModel();
		$this->validation =  \Config\Services::validation();
		$this->db      = \Config\Database::connect();
	}

	public function index()
	{
		$data = [
			'title' => 'Manajemen Users',
			'active' => 'users',
			'js' => 'users.js',
		];

		return view('users/index', $data);
	}

	public function datatables()
	{
		if ($this->request->isAjax()) {
			$builder = $this->db->table('users')
				->select('kd_user, nama, hak_akses, lasted_login, status, foto');

			return DataTable::of($builder)
				->addNumbering('no')
				->add('lasted_login', function ($row) {
					if ($row->lasted_login == null) {
						$last = 'Belum Pernah Login';
					} else {
						$last = convertTanggal(date('Y-m-d', strtotime($row->lasted_login))) . ' ' . date('H:i:s', strtotime($row->lasted_login));
					}
					return $last;
				})
				->add('status', function ($row) {
					if ($row->status == 'aktif') {
						$label_color = 'success';
						$label = 'Aktif';
					} else {
						$label_color = 'danger';
						$label = 'Tidak Aktif';
					}
					return "<label class=\"label label-inverse-" . $label_color . "\">" . $label . "</label>";
				})
				->add('hak_akses', function ($row) {
					if ($row->hak_akses == 'admin') {
						$label = 'primary';
					} else {
						$label = 'info';
					}
					return "<label class=\"label label-inverse-" . $label . "\">" . $row->hak_akses . "</label>";
				})
				->add('option', function ($row) {
					return "<a href=\"" . site_url('Users/detail/' . param_encrypt($row->kd_user)) . "\" class=\"btn btn-mini btn-primary mx-1\" data-toggle=\"tooltip\" title=\"Detail\"><i class=\"ti-zoom-in m-0\"></i></a><button onclick=\"form_edit('". param_encrypt($row->kd_user)."')\" class=\"btn btn-mini btn-warning mx-1\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"ti-pencil-alt m-0\"></i></button><button class=\"btn btn-mini btn-danger mx-1\" data-toggle=\"tooltip\" title=\"Hapus\" onclick=\"hapus('" . param_encrypt($row->kd_user) . "')\"><i class=\"ti-trash m-0\"></i></button>";
				})
				->toJson(true);
		}
	}

	public function form_add()
	{
		if ($this->request->isAJAX()) {
			$msg = [
				'message' => view('users/modal_tambah')
			];
			echo json_encode($msg);
		}
	}

	public function create()
	{
		if ($this->request->isAJAX()) {
			$validasi = $this->validate([
				'nama' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama harus di isi'
					]
				],
				'username' => [
					'rules' => 'required|is_unique[users.username]',
					'errors' => [
						'required' => 'username harus di isi',
						'is_unique' => 'Username sudah digunakan',
					]
				],
				'password' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'password harus di isi'
					]
				],
				'ulangi_password' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Ulangi password harus di isi',
						'matches' => 'password tidak sama'
					]
				],
				'hak_akses' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Hak Akses harus di isi'
					]
				],
				'status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Status harus di isi'
					]
				],
				'foto' => [
					'rules' => 'mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]|is_image[foto]|max_size[foto,2096]',
					'errors' => [
						'mime_in' => 'File Extention Harus Berupa png/jpg/jpeg/JPG',
						'max_size' => 'Ukuran File Maksimal 2 MB'
					]
				],
			]);

			if (!$validasi) {
				$msg = [
					'error' => [
						'nama' => $this->validation->getError('nama'),
						'username' => $this->validation->getError('username'),
						'password' => $this->validation->getError('password'),
						'ulangi_password' => $this->validation->getError('ulangi_password'),
						'hak_akses' => $this->validation->getError('hak_akses'),
						'status' => $this->validation->getError('status'),
						'foto' => $this->validation->getError('foto'),
					]
				];
			} else {
				$foto = $this->request->getFile('foto');
				$filename = $foto->getRandomName();

				if ($foto->isValid()) {
					$filename = $foto->getRandomName();
					$foto->move('assets/images/profile', $filename);
				} else {
					$filename = 'default.png';
				}

				$data = [
					'kd_user' => get_kode('users', 'kd_user', 'USR'),
					'nama' => $this->request->getVar('nama'),
					'username' => $this->request->getVar('username'),
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
					'hak_akses' => $this->request->getVar('hak_akses'),
					'status' => $this->request->getVar('status'),
					'foto' => $filename,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->usersModel->insert($data);


				$msg = [
					'message' =>  'Data berhasil di tambah',
				];
			}

			echo json_encode($msg);
		} else {
			$data = [
				'title' => 'Manajemen Users',
				'active' => 'users',
			];

			return view('users/form_tambah', $data);
		}
	}

	public function form_edit()
	{
		if ($this->request->isAjax()) {
			$kd_user = param_decrypt($this->request->getVar('kd_user'));
			$users = $this->usersModel->find($kd_user);
			$data = [
				'users' => $users,
			];

			$msg = [
				'message' => view('users/modal_edit', $data),
			];

			echo json_encode($msg);
		}
	}

	public function update($kd_user = null)
	{
		if ($this->request->isAJAX()) {
			$kd_user = param_decrypt($this->request->getVar('kd_user'));
			$old_data = $this->usersModel->find($kd_user);
			if ($old_data['username'] == $this->request->getVar('username')) {
				$rules_username = 'required';
			} else {
				$rules_username = 'required|is_unique[users.username]';
			}

			$validasi = $this->validate([
				'nama' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Nama harus di isi'
					]
				],
				'username' => [
					'rules' => $rules_username,
					'errors' => [
						'required' => 'username harus di isi',
						'is_unique' => 'Username sudah digunakan',
					]
				],
				'ulangi_password' => [
					'rules' => 'matches[password]',
					'errors' => [
						'matches' => 'password tidak sama'
					]
				],
				'hak_akses' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Hak Akses harus di isi'
					]
				],
				'status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Status harus di isi'
					]
				],
				'foto' => [
					'rules' => 'mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]|is_image[foto]|max_size[foto,2096]',
					'errors' => [
						'mime_in' => 'File Extention Harus Berupa png/jpg/jpeg/JPG',
						'max_size' => 'Ukuran File Maksimal 2 MB'
					]
				],
			]);

			if (!$validasi) {
				$msg = [
					'error' => [
						'nama' => $this->validation->getError('nama'),
						'username' => $this->validation->getError('username'),
						'hak_akses' => $this->validation->getError('hak_akses'),
						'status' => $this->validation->getError('status'),
						'ulangi_password' => $this->validation->getError('ulangi_password'),
						'foto' => $this->validation->getError('foto'),
					]
				];
			} else {
				$foto = $this->request->getFile('foto');
				if ($foto->isValid()) {
					$filename = $foto->getRandomName();
					@unlink('assets/images/profile/' . $old_data['foto']);
					$foto->move('assets/images/profile', $filename);
				} else {
					$filename = $old_data['foto'];
				}

				if ($this->request->getVar('password') != '') {
					$password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
				} else {
					$password = $old_data['password'];
				}

				$data = [
					'nama' => $this->request->getVar('nama'),
					'username' => $this->request->getVar('username'),
					'password' => $password,
					'hak_akses' => $this->request->getVar('hak_akses'),
					'status' => $this->request->getVar('status'),
					'foto' => $filename,
					'updated_at' => date('Y-m-d H:i:s'),
				];
				$this->usersModel->update($kd_user, $data);


				$msg = [
					'message' =>  'Data berhasil di ubah',
				];
			}

			echo json_encode($msg);
		} else {
			$data = [
				'title' => 'Manajemen Users',
				'active' => 'users',
				'users' => $this->usersModel->find(param_decrypt($kd_user))
			];

			return view('users/form_edit', $data);
		}
	}

	public function detail($kd_user)
	{
		$data = [
			'title' => 'Manajemen Users',
			'active' => 'users',
			'users' => $this->usersModel->find(param_decrypt($kd_user))
		];

		return view('users/detail', $data);
	}

	public function change_password()
	{
		if ($this->request->isAjax()) {
			$validasi = $this->validate([
				'password_lama' => [
					'rules' => 'required|min_length[3]',
					'errors' => [
						'required' => 'Password lama harus di isi',
						'min_length' => 'Password harus di isi minimal 6 angka',
					]
				],
				'password' => [
					'rules' => 'required|min_length[3]|differs[password_lama]',
					'errors' => [
						'required' => 'Password harus di isi',
						'min_length' => 'Password harus di isi minimal 3 angka',
						'differs' => 'Password harus berbeda dengan password lama'
					]
				],
				'ulangi_password' => [
					'rules' => 'required|min_length[3]|matches[password]',
					'errors' => [
						'required' => 'Ulangi password harus di isi',
						'min_length' => 'Password harus di isi minimal 3 angka',
						'matches' => 'Password tidak sama'
					]
				]
			]);

			if (!$validasi) {
				$msg = [
					'error' => [
						'password_lama' => $this->validation->getError('password_lama'),
						'password' => $this->validation->getError('password'),
						'ulangi_password' => $this->validation->getError('ulangi_password'),
					]
				];
			} else {
				$kd_user = param_decrypt($this->request->getVar('kd_user'));
				$password_lama = $this->request->getVar('password_lama');
				$data = $this->usersModel->find($kd_user);
				$cek_password = password_verify($password_lama, $data['password']);

				if (!$cek_password) {
					$msg = [
						'error' => [
							'password_lama' => 'Password lama tidak sesuai',
						]
					];
				} else {
					$changed_password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

					$data = [
						'password' => $changed_password
					];

					$this->usersModel->update($kd_user, $data);

					$msg = [
						'message' => 'Password berhasil di ubah!'
					];
				}
			}
			echo json_encode($msg);
		}
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$kd_user = param_decrypt($this->request->getVar('kd_user'));
			$old_data = $this->usersModel->find($kd_user);
			if ($old_data['foto'] != 'default.png') {
				@unlink('assets/images/profile/' . $old_data['foto']);
			}
			$this->usersModel->delete($kd_user);

			$msg = [
				'message' => 'Data berhasil dihapus!',
			];
			echo json_encode($msg);
		}
	}
}

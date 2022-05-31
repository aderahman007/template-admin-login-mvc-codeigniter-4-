<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model {
    
	protected $table = 'users';
	protected $primaryKey = 'kd_user';
	protected $useAutoIncrement = false;
	protected $allowedFields = ['kd_user', 'nama', 'username', 'password', 'hak_akses', 'foto', 'lasted_login', 'status', 'created_at', 'updated_at'];

	
}
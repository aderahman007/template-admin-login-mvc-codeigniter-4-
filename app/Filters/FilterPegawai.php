<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterPegawai implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->logged_in) {
            return redirect()->to('Auth');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->hak_akses != 'admin') {
            return redirect()->to('/');
        }
    }
}

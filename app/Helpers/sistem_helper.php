<?php
function sistem()
{
    $db      = \Config\Database::connect();

    $query = $db->table('manajemen_sistem')->get();
    return $query->getFirstRow();
}

function param_encrypt($p)
{
    $encrypter = \Config\Services::encrypter();
    return bin2hex($encrypter->encrypt($p));
}

function param_decrypt($p)
{
    $encrypter = \Config\Services::encrypter();
    return $encrypter->decrypt(hex2bin($p));
}

function convertTanggal($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function convertBulan($bulan)
{
    switch ($bulan) {
        case '1':
            return 'January';
            break;
        case '2':
            return 'February';
            break;
        case '3':
            return 'Maret';
            break;
        case '4':
            return 'April';
            break;
        case '5':
            return 'Mei';
            break;
        case '6':
            return 'Juni';
            break;
        case '7':
            return 'Juli';
            break;
        case '8':
            return 'Agustus';
            break;
        case '9':
            return 'September';
            break;
        case '10':
            return 'Oktober';
            break;
        case '11':
            return 'November';
            break;
        default:
            return 'Desember';
            break;
    }
}

function get_kode($table, $primaryKey, $prefix)
{
    $db = db_connect();

    $query = $db->query("SELECT MAX($primaryKey) as max_kode FROM $table")->getFirstRow('array');

    if ($query <> 0) {
        $urutan_kode = (int) substr($query['max_kode'], 4, 5) + 1;
    } else {
        $urutan_kode = 1;
    }

    $kode = $prefix . '-' . sprintf('%05s', $urutan_kode);
    return $kode;
}

// breadcrumbs
// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home')
{
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) : 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = array("<a href=\"$base\">$home</a>");

    // Initialize crumbs to track path for proper link
    $crumbs = '';

    // Find out the index for the last value in our path array
    $last = end($path);

    // Build the rest of the breadcrumbs
    foreach ($path as $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(array('.php', '_', '%20'), array('', ' ', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last) {
            $breadcrumbs[] = "<a href=\"$base$crumbs$crumb\">$title</a>";
            $crumbs .= $crumb . '/';
        }
        // Otherwise, just display the title (minus)
        else {
            $breadcrumbs[] = $title;
        }
    }

    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}

function getIdProvinsi($nama)
{
    if ($nama == null) {
        return '';
    } else {
        $db      = \Config\Database::connect();
        $q = $db->table('wilayah_provinsi')->select('id')->where('nama', $nama)->get()->getRowArray();

        if (!empty($q)) {
            return $q['id'];
        }else {
            return 'Data tidak ditemukan!';
        }
    }
}
function getProvinsi($id)
{
    if ($id == null) {
        return '';
    } else {
        $db      = \Config\Database::connect();
        $q = $db->table('wilayah_provinsi')->select('nama')->where('id', $id)->get()->getRowArray();
        
        if (!empty($q)) {
            return $q['nama'];
        }else {
            return 'Data tidak ditemukan!';
        }
    }
}

function getKabupaten($id)
{
    if ($id == null) {
        return '';
    } else {
        $db      = \Config\Database::connect();
        $q = $db->table('wilayah_kabupaten')->select('nama')->where('id', $id)->get()->getRowArray();

        if (!empty($q)) {
            return $q['nama'];
        } else {
            return 'Data tidak ditemukan!';
        }
    }
}
function getKecamatan($id)
{
    if ($id == null) {
        return '';
    } else {
        $db      = \Config\Database::connect();
        $q = $db->table('wilayah_kecamatan')->select('nama')->where('id', $id)->get()->getRowArray();

        if (!empty($q)) {
            return $q['nama'];
        } else {
            return 'Data tidak ditemukan!';
        }
    }
}
function getDesa($id)
{
    if ($id == null) {
        return '';
    } else {
        $db      = \Config\Database::connect();
        $q = $db->table('wilayah_desa')->select('nama')->where('id', $id)->get()->getRowArray();

        if (!empty($q)) {
            return $q['nama'];
        } else {
            return 'Data tidak ditemukan!';
        }
    }
}
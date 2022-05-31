<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div id="view-content">
    <div class="row">
        <div class="col-sm-8">
            <!-- Manajemen Users card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Detail User</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-times close-card"></i></li>
                        </ul>
                    </div>
                    <hr>
                </div>

                <div class="card-block table-border-style">
                    <div class="col-sm-12 col-xl-12">
                        <dl class="dl-horizontal row">
                            <dt class="col-sm-3">Kode User</dt>
                            <dd class="col-sm-9"><?= $users['kd_user']; ?></dd>
                            <dt class="col-sm-3">Nama Lengkap</dt>
                            <dd class="col-sm-9"><?= $users['nama']; ?></dd>
                            <dt class="col-sm-3">Username</dt>
                            <dd class="col-sm-9"><?= $users['username']; ?></dd>
                            <dt class="col-sm-3">Hak Akses</dt>
                            <dd class="col-sm-9"><?= ($users['hak_akses'] == 'admin') ? '<label class="label label-inverse-primary">Admin</label>' : '<label class="label label-inverse-info">Pegawai</labe'; ?></dd>
                            <dt class="col-sm-3 ">Terakhir Login</dt>
                            <dd class="col-sm-9"><?= ($users['lasted_login'] == null) ? '-' : convertTanggal(date('Y-m-d', strtotime($users['lasted_login'])), true); ?></dd>
                            <dt class="col-sm-3 ">Status</dt>
                            <dd class="col-sm-9"><?= ($users['status'] == 'aktif') ? '<label class="label label-inverse-primary">Aktif</label>' : '<label class="label label-inverse-danger">Tidak Aktif</labe'; ?></dd>
                        </dl>
                    </div>
                    <a href="<?= site_url('users'); ?>" class="btn btn-sm btn-secondary btn-round btn-cencel mx-2 float-right">Kembali</a>
                    <button data-toggle="modal" data-target="#ubah-password" class="btn btn-sm btn-info btn-round btn-cencel mx-2 float-right">Ubah Password</button>
                </div>
            </div>
            <!-- Basic table card end -->
        </div>
        <div class="col-sm-4">
            <!-- Manajemen Users card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Foto User</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-times close-card"></i></li>
                        </ul>
                    </div>
                </div>

                <div class="card-block table-border-style">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="border-radius: 50%;">
                                <img src="<?= base_url('assets/images/profile/' . $users['foto']); ?>" class="rounded mx-auto d-block mb-3" alt="profile" id="profile" style="width: 240px; height: 240px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic table card end -->
        </div>
    </div>
</div>

<div class="view_modal"></div>

<div class="modal fade" id="ubah-password" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-ubah-password">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= param_encrypt($users['kd_user']); ?>">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                        <div class="invalid-feedback error_password_lama"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <div class="invalid-feedback error_password"></div>
                    </div>
                    <div class="form-group">
                        <label for="ulangi_password">Ulangi Password</label>
                        <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" placeholder="Ulangi Password">
                        <div class="invalid-feedback error_ulangi_password"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-round btn-primary btn-ubah-password" id="change-password">Ubah Password</button>
                <button type="button" class="btn btn-sm btn-round btn-secondary btn-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
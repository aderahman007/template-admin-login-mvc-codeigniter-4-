<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="kd_user" value="<?= param_encrypt($users['kd_user']); ?>">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $users['nama']; ?>">
                                <div class="invalid-feedback error_nama"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $users['username']; ?>">
                                <div class="invalid-feedback error_username"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <div class="invalid-feedback error_password"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="ulangi_password">Ulangi Password</label>
                                <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" placeholder="Ulangi Password">
                                <div class="invalid-feedback error_ulangi_password"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="hak_akses">Hak Akses</label>
                                        <select class="form-control" id="hak_akses" name="hak_akses">
                                            <option selected disabled value="">Pilih Hak Akses</option>
                                            <option value="admin" <?= ($users['hak_akses'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            <option value="pegawai" <?= ($users['hak_akses'] == 'pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                        </select>
                                        <div class="invalid-feedback error_hak_akses"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option selected disabled value="">Pilih Status</option>
                                            <option value="aktif" <?= ($users['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="tidak_aktif" <?= ($users['status'] == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback error_status"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="foto">Foto Profile</label>
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                <div class="invalid-feedback error_foto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="border-radius: 50%;">
                                <img src="<?= base_url('assets/images/profile/' . $users['foto']); ?>" class="rounded mx-auto d-block" alt="profile" id="profile-form" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-round btn-secondary btn-cencel" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-round btn-primary btn-simpan" onclick="update()">Tambah User</button>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-form').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto").change(function() {
        readURL(this);
    });
</script>
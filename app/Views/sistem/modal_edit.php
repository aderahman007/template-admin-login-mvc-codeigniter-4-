<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sistem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= param_encrypt($sistem['id']); ?>">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="nama">Nama Sistem</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Sistem" value="<?= $sistem['nama']; ?>">
                                <div class="invalid-feedback error_nama"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner" value="<?= $sistem['owner']; ?>">
                                <div class="invalid-feedback error_owner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="telpon">Telpon</label>
                                <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Telpon" value="<?= $sistem['telpon']; ?>" onkeypress="return hanyaAngka(event)">
                                <div class="invalid-feedback error_telpon"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $sistem['email']; ?>">
                                <div class="invalid-feedback error_email"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="running_text">Running Text</label>
                                <input type="text" class="form-control" id="running_text" name="running_text" placeholder="Running Text" value="<?= $sistem['running_text']; ?>">
                                <div class="invalid-feedback error_running_text"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="logo">Logo <sub><small class="text-primary">Ukuran logo 45x45px</small></sub></label>
                                <input type="file" class="form-control" name="logo" id="logo" accept="image/png,image/gif">
                                <div class="invalid-feedback error_logo"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?= $sistem['alamat']; ?></textarea>
                                <div class="invalid-feedback error_alamat"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="tentang">Tentang</label>
                                <textarea class="form-control" rows="4" name="tentang" id="tentang" placeholder="Tentang"><?= $sistem['tentang']; ?></textarea>
                                <div class="invalid-feedback error_tentang"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="border-radius: 50%;">
                                <img src="<?= base_url('assets/images/sistem/' . $sistem['logo']); ?>" class="rounded mx-auto d-block" alt="sistem" id="sistem" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-round btn-secondary btn-cencel" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-round btn-primary btn-simpan" onclick="update()">Update Sistem</button>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#sistem').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo").change(function() {
        readURL(this);
    });
</script>
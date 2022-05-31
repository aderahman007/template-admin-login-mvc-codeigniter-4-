<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div id="view-content">
    <div class="row">
        <div class="col-sm-8">
            <!-- Manajemen Users card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Manajemen Sistem</h5>
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
                    <dl class="dl-horizontal row">
                        <dt class="col-sm-3">Nama Sistem</dt>
                        <dd class="col-sm-9"><?= $sistem['nama']; ?></dd>
                        <dt class="col-sm-3">Owner</dt>
                        <dd class="col-sm-9"><?= $sistem['owner']; ?></dd>
                        <dt class="col-sm-3">Telpon</dt>
                        <dd class="col-sm-9"><?= $sistem['telpon']; ?></dd>
                        <dt class="col-sm-3 ">Email</dt>
                        <dd class="col-sm-9"><?= $sistem['email']; ?></dd>
                        <dt class="col-sm-3 ">Alamat</dt>
                        <dd class="col-sm-9"><?= $sistem['alamat']; ?></dd>
                        <dt class="col-sm-3 ">Running Text</dt>
                        <dd class="col-sm-9"><?= $sistem['running_text']; ?></dd>
                        <dt class="col-sm-3 ">Tentang</dt>
                        <dd class="col-sm-9"><?= $sistem['tentang']; ?></dd>
                    </dl>
                    <button onclick="form_edit('<?= param_encrypt($sistem['id']); ?>')" class="btn btn-sm btn-primary btn-round mx-2 float-right">Update</button>
                    <a href="<?= site_url('users'); ?>" class="btn btn-sm btn-secondary btn-round btn-cencel mx-2 float-right">Kembali</a>
                </div>
            </div>
            <!-- Basic table card end -->
        </div>
        <div class="col-sm-4">
            <!-- Manajemen Users card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Logo</h5>
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
                                <img src="<?= base_url('assets/images/sistem/' . $sistem['logo']); ?>" class="rounded mx-auto d-block mb-3" alt="logo" style="width: 268px; height: 268px;">
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

<?= $this->endSection(); ?>
<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div id="view-content">
    <div class="row">
        <div class="col-sm-12">
            <!-- Manajemen Users card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Manajemen Users</h5>
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
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary btn-round mx-2" onclick="form_add()">Tambah Users</button>
                </div>
                <div class="card-block table-border-style">
                    <!-- <div class="table-responsive"> -->
                        <table class="table table-hover" id="datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode User</th>
                                    <th>Nama</th>
                                    <th>Hak Akses</th>
                                    <th>Status</th>
                                    <th>Terakhir Login</th>
                                    <th>Foto</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>
            </div>
            <!-- Basic table card end -->
        </div>
    </div>
</div>

<div class="view_modal"></div>

<?= $this->endSection(); ?>
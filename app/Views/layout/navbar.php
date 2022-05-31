<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <div class="mobile-search">
                <div class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?= site_url(); ?>">
                <div class="row mx-auto">
                    <img class="img-fluid" src="<?= base_url(); ?>/assets/images/sistem/<?= sistem()->logo; ?>" alt="Theme-Logo" />
                    <?php
                    $nama = explode(' ', sistem()->nama);
                    $display_nama = $nama[1] . ' ' . $nama[2];
                    ?>
                    <h6 class="text-white mt-3"><?= $display_nama; ?></h6>
                </div>
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
                <li>
                    <div class="col-md-12 col-xs-6">
                        <marquee behavior="" direction="" class="align-middle mt-2">
                            <h5 class="text-white text-center"><?= sistem()->running_text; ?></h5>
                        </marquee>
                    </div>
                </li>
            </ul>
            <ul class="nav-right">
                <li>
                    <div class="align-middle mt-2">
                        <h5 class="text-white text-center" id="jam_berjalan"></h5>
                        <h6 class="text-white text-center"><?= convertTanggal(date('Y-m-d'), true); ?></h6>
                    </div>
                </li>
                <li class="user-profile header-notification">
                    <a href="#!">
                        <!-- class="img-radius" -->
                        <img src="<?= base_url('assets/images/profile/' . session()->foto); ?>" alt="User-Profile-Image" style="width: 40px; height: 40px; border-radius: 50%!important;">
                        <span><?= session()->nama; ?></span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li>
                            <a href="#!">
                                <i class="ti-settings"></i> Manajemen Sistem
                            </a>
                        </li>
                        <li>
                            <a href="user-profile.html">
                                <i class="ti-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-logout">
                                <i class="ti-unlock"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
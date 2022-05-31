<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu Utama</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($active == 'dashboard') ? 'active' : ''; ?>">
                <a href="<?= site_url(); ?>">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            
            <li>
                <a href="index.html">
                    <span class="pcoded-micon"><i class="ti-files"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Laporan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Master Data</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="index.html">
                    <span class="pcoded-micon"><i class="ti-package"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Data Barang</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Administrator</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($active == 'manajemen_sistem') ? 'active' : ''; ?>">
                <a href="<?= site_url('Sistem'); ?>">
                    <span class="pcoded-micon"><i class="ti-settings"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Manajemen Sistem</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="<?= ($active == 'users') ? 'active' : ''; ?>">
                <a href="<?= site_url('users'); ?>">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Manajemen Users</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other">Lainya</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="#" class="btn-logout">
                    <span class="pcoded-micon"><i class="ti-lock"></i><b>L</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Logout</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>
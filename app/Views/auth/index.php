<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title . ' || ' . sistem()->nama; ?></title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
    <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(); ?>/assets/gradient_able/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/gradient_able/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/gradient_able/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/gradient_able/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/gradient_able/css/style.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" id="form-login">
                            <div class="row">
                                <div class="mx-auto">
                                    <div class="row">
                                        <img width="30px" src="<?= base_url('assets/images/sistem/' . sistem()->logo); ?>" alt="logo.png">
                                        <h4 class="mt-2"><?= sistem()->nama; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Login</h3>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                                    <div class="text-left invalid-feedback error_username"></div>
                                    <span class="md-line">

                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                    <span class="md-line"></span>
                                    <div class="text-left invalid-feedback error_password"></div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 btn-login">Login</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Sistem Informasi Persediaan dan Penjualan.</p>
                                        <p class="text-inverse text-left"><b><?= sistem()->nama; ?></b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="<?= base_url('assets/images/sistem/' . sistem()->logo); ?>" alt="small-logo.png">
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/common-pages.js"></script>
    <!-- sweetaler2 -->
    <script src="<?= base_url(); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        var site_url = '<?= site_url(); ?>';
        var base_url = '<?= base_url(); ?>';
    </script>

    <?php
    if (isset($js)) {
        echo '<script src="' . base_url('assets/apps/' . $js) . '"></script>';
    }
    ?>
</body>

</html>
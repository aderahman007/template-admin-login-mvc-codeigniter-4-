<!-- Required Jquery -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/modernizr/modernizr.js"></script>
<!-- am chart -->
<script src="<?= base_url(); ?>/assets/gradient_able/pages/widget/amchart/amcharts.min.js"></script>
<script src="<?= base_url(); ?>/assets/gradient_able/pages/widget/amchart/serial.min.js"></script>
<!-- Chart js -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/chart.js/Chart.js"></script>
<!-- Todo js -->
<script type="text/javascript " src="<?= base_url(); ?>/assets/gradient_able/pages/todo/todo.js "></script>
<!-- Custom js -->
<!-- <script type="text/javascript" src="<? //= base_url(); 
                                            ?>/assets/gradient_able/pages/dashboard/custom-dashboard.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/gradient_able/js/script.js"></script>
<!-- <script type="text/javascript " src="<?//= base_url(); ?>/assets/gradient_able/js/SmoothScroll.js"></script> -->
<script src="<?= base_url(); ?>/assets/gradient_able/js/pcoded.min.js"></script>
<script src="<?= base_url(); ?>/assets/gradient_able/js/vartical-demo.js"></script>
<script src="<?= base_url(); ?>/assets/gradient_able/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- sweetaler2 -->
<script src="<?= base_url(); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- datatables -->
<script src="<?= base_url(); ?>/assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/select2/js/select2.min.js"></script>

<script>
    var site_url = '<?= site_url(); ?>';
    var base_url = '<?= base_url(); ?>';
</script>

<?php
if (isset($js)) {
    echo '<script src="' . base_url('assets/apps/' . $js) . '"></script>';
}
?>

<script>
    $(document).ready(function() {
        window.setTimeout("waktu()", 1000);
        logout();
        
    });

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        var jam_berjalan = set(waktu.getHours()) + ':' + set(waktu.getMinutes()) + ':' + set(waktu.getSeconds());
        document.getElementById("jam_berjalan").innerHTML = jam_berjalan;
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }

    function logout() {
        $('.btn-logout').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Anda yakin ingin logout?',
                text: "Anda akan logout dari sistem dan anda bisa login kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('Auth/logout') ?>',
                        dataType: "json",
                        error: function(xhr, ajaxOptions, thrownerror) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                                thrownerror);
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: response.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2100
                                });
                                setTimeout(function() {
                                    window.location.href = "<?= site_url('Auth'); ?>"
                                }, 2500);
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: 'Terjadi kesalahan server1',
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 2100
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownerror) {
                            Swal.fire({
                                title: "Maaf Kelasalahan Server!",
                                html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2100
                            });
                        }
                    });
                }
            })

        });
    }
</script>
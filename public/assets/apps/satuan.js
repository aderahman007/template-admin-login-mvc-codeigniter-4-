$(document).ready(function() {
        loadData();
    });

    function readURLLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto").change(function() {
        readURLLogo(this);
    });

    function loadData() {
        $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            responsive: true,
            ajax: site_url + 'Satuan/datatables',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'kd_satuan'
                },
                {
                    data: 'satuan'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'option',
                    orderable: false
                },
            ],
            columnDefs: [{
                    targets: [0, 4],
                    className: "align-middle text-center",
                },
                {
                    targets: [1, 2, 3],
                    className: "align-middle",
                },
            ],
            responsive:true,
            "order": [
                [1, "desc"]
            ],
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    function form_add() {
        $.ajax({
            url: site_url + 'Satuan/form_add',
            dataType: "json",
            success: function(response) {
                $('.view_modal').html(response.message).show();
                $('#modal-tambah').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true,
                });
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    $('#modal-tambah').modal('hide');
                })
            }
        });
    }

    function create() {
        const data = $('#form-tambah').serialize();
        $.ajax({
            type: "post",
            url: site_url + 'Satuan/create',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $('.btn-simpan').html('<i class="fa fa-spin fa-spinner"></i> loading');
                $(".btn-cencel").hide(100);
                $('.btn-simpan').attr('disabled', true);
            },
            complete: function() {
                $('.btn-simpan').removeAttr('disabled');
                $(".btn-cencel").show(100);
                $('.btn-simpan').html('Tambah Satuan');
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownerror);
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.satuan) {
                        $('#satuan').addClass('is-invalid');
                        $('.error_satuan').html(response.error.satuan);
                    } else {
                        $('#satuan').removeClass('is-invalid');
                        $('.error_satuan').html('');
                    }
                    if (response.error.keterangan) {
                        $('#keterangan').addClass('is-invalid');
                        $('.error_keterangan').html(response.error.keterangan);
                    } else {
                        $('#keterangan').removeClass('is-invalid');
                        $('.error_keterangan').html('');
                    }

                } else {
                    $('#modal-tambah').modal('hide');
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2100
                    });
                    loadData();

                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                $('#modal-tambah').modal('hide');
                Swal.fire({
                    title: "Maaf data gagal di buat!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2100
                });
            }
        });

    }

    function form_edit(kode) {
        $.ajax({
            type: "post",
            url: site_url + 'Satuan/form_edit',
            data: {
                kd_satuan: kode
            },
            dataType: "json",
            success: function(response) {
                $('.view_modal').html(response.message).show();
                $('#modal-edit').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true,
                });
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    $('#modal-edit').modal('hide');
                })
            }
        });
    }

    function update() {
        const data = $('#form-edit').serialize();
        $.ajax({
          type: "post",
          url: site_url + "Satuan/update",
          data: data,
          dataType: "json",
          beforeSend: function () {
            $(".btn-simpan").html(
              '<i class="fa fa-spin fa-spinner"></i> loading'
            );
            $(".btn-cencel").hide(100);
            $(".btn-simpan").attr("disabled", true);
          },
          complete: function () {
            $(".btn-simpan").removeAttr("disabled");
            $(".btn-cencel").show(100);
            $(".btn-simpan").html("Update Satuan");
          },
          error: function (xhr, ajaxOptions, thrownerror) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownerror);
          },
          success: function (response) {
            if (response.error) {
              if (response.error.satuan) {
                $("#satuan").addClass("is-invalid");
                $(".error_satuan").html(response.error.satuan);
              } else {
                $("#satuan").removeClass("is-invalid");
                $(".error_satuan").html("");
              }
              if (response.error.keterangan) {
                $("#keterangan").addClass("is-invalid");
                $(".error_keterangan").html(response.error.keterangan);
              } else {
                $("#keterangan").removeClass("is-invalid");
                $(".error_keterangan").html("");
              }
            } else {
              $("#modal-edit").modal("hide");
              Swal.fire({
                title: "Berhasil!",
                text: response.message,
                icon: "success",
                showConfirmButton: false,
                timer: 2100,
              });
              loadData();
            }
          },
          error: function (xhr, ajaxOptions, thrownerror) {
            $("#modal-edit").modal("hide");
            Swal.fire({
              title: "Maaf data gagal di ubah!",
              html: `Silahkan Cek kembali Kode Error: <strong>${
                xhr.status + "\n"
              }</strong> `,
              icon: "error",
              showConfirmButton: false,
              timer: 2100,
            });
          },
        });
    }

    function hapus(kd_satuan) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Poreses ini akan menghapus data secara permanent!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: site_url + "Satuan/delete",
                  data: {
                    kd_satuan: kd_satuan,
                  },
                  type: "POST",
                  dataType: "JSON",
                  success: function (response) {
                    Swal.fire({
                      title: "Berhasil!",
                      text: response.message,
                      icon: "success",
                      showConfirmButton: false,
                      timer: 2100,
                    });
                    loadData();
                  },
                  error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                      title: "Maaf data gagal di ubah!",
                      html: `Silahkan Cek kembali Kode Error: <strong>${
                        jqXHR.status + "\n"
                      }</strong> `,
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2100,
                    });
                  },
                });
            }
        })
    }
$(document).ready(function () {
  loadData();
  change_password();
});

function readURLLogo(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#profile").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$("#foto").change(function () {
  readURLLogo(this);
});

function loadData() {
  $("#datatables").DataTable({
    processing: true,
    serverSide: true,
    bDestroy: true,
    responsive: true,
    ajax: site_url + "Users/datatables",
    order: [],
    columns: [
      {
        data: "no",
        orderable: false,
      },
      {
        data: "kd_user",
      },
      {
        data: "nama",
      },
      {
        data: "hak_akses",
      },
      {
        data: "status",
      },
      {
        data: "lasted_login",
      },
      {
        data: "foto",
        render: function (data) {
          return (
            "<img src=" +
            site_url +
            "assets/images/profile/" +
            data +
            ' class="rounded mx-auto d-block" alt="profile" id="profile" style="width: 50px; height: 50px; border-radius:50% !important">'
          );
        },
      },
      {
        data: "option",
        orderable: false,
      },
    ],
    columnDefs: [
      {
        targets: [3, 4, 6],
        className: "align-middle",
      },
      {
        targets: [0, 7],
        className: "align-middle text-center",
      },
      {
        targets: [1, 2, 5],
        className: "align-middle",
      },
    ],
    responsive: true,
    order: [[1, "desc"]],
    drawCallback: function (settings) {
      $('[data-toggle="tooltip"]').tooltip();
    },
  });
}

function form_add() {
  $.ajax({
    url: site_url + "Users/form_add",
    dataType: "json",
    success: function (response) {
      $(".view_modal").html(response.message).show();
      $("#modal-tambah").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
    },
    error: function (xhr, ajaxOptions, thrownerror) {
      Swal.fire({
        title: "Maaf gagal load data!",
        html: `Silahkan Cek kembali Kode Error: <strong>${
          xhr.status + "\n"
        }</strong> `,
        icon: "error",
        showConfirmButton: false,
        timer: 3100,
      }).then(function () {
        $("#modal-tambah").modal("hide");
      });
    },
  });
}

function create() {
  const form = $("#form-tambah")[0];
  const data = new FormData(form);
  $.ajax({
    type: "post",
    url: site_url + "Users/create",
    data: data,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    cache: false,
    dataType: "json",
    beforeSend: function () {
      $(".btn-simpan").html('<i class="fa fa-spin fa-spinner"></i> loading');
      $(".btn-cencel").hide(100);
      $(".btn-simpan").attr("disabled", true);
    },
    complete: function () {
      $(".btn-simpan").removeAttr("disabled");
      $(".btn-cencel").show(100);
      $(".btn-simpan").html("Tambah User");
    },
    error: function (xhr, ajaxOptions, thrownerror) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownerror);
    },
    success: function (response) {
      if (response.error) {
        if (response.error.nama) {
          $("#nama").addClass("is-invalid");
          $(".error_nama").html(response.error.nama);
        } else {
          $("#nama").removeClass("is-invalid");
          $(".error_nama").html("");
        }
        if (response.error.username) {
          $("#username").addClass("is-invalid");
          $(".error_username").html(response.error.username);
        } else {
          $("#username").removeClass("is-invalid");
          $(".error_username").html("");
        }
        if (response.error.password) {
          $("#password").addClass("is-invalid");
          $(".error_password").html(response.error.password);
        } else {
          $("#password").removeClass("is-invalid");
          $(".error_password").html("");
        }
        if (response.error.ulangi_password) {
          $("#ulangi_password").addClass("is-invalid");
          $(".error_ulangi_password").html(response.error.ulangi_password);
        } else {
          $("#ulangi_password").removeClass("is-invalid");
          $(".error_ulangi_password").html("");
        }
        if (response.error.hak_akses) {
          $("#hak_akses").addClass("is-invalid");
          $(".error_hak_akses").html(response.error.hak_akses);
        } else {
          $("#hak_akses").removeClass("is-invalid");
          $(".error_hak_akses").html("");
        }
        if (response.error.foto) {
          $("#foto").addClass("is-invalid");
          $(".error_foto").html(response.error.foto);
        } else {
          $("#foto").removeClass("is-invalid");
          $(".error_foto").html("");
        }
      } else {
        $("#modal-tambah").modal("hide");
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
      $("#modal-tambah").modal("hide");
      Swal.fire({
        title: "Maaf data gagal di buat!",
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

function form_edit(kode) {
  $.ajax({
    type: "post",
    url: site_url + "Users/form_edit",
    data: {
      kd_user: kode,
    },
    dataType: "json",
    success: function (response) {
      $(".view_modal").html(response.message).show();
      $("#modal-edit").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
    },
    error: function (xhr, ajaxOptions, thrownerror) {
      Swal.fire({
        title: "Maaf gagal load data!",
        html: `Silahkan Cek kembali Kode Error: <strong>${
          xhr.status + "\n"
        }</strong> `,
        icon: "error",
        showConfirmButton: false,
        timer: 3100,
      }).then(function () {
        $("#modal-edit").modal("hide");
      });
    },
  });
}

function update() {
  const form = $("#form-edit")[0];
  const data = new FormData(form);
  $.ajax({
    type: "post",
    url: site_url + "Users/update",
    data: data,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    cache: false,
    dataType: "json",
    beforeSend: function () {
      $(".btn-simpan").html('<i class="fa fa-spin fa-spinner"></i> loading');
      $(".btn-cencel").hide(100);
      $(".btn-simpan").attr("disabled", true);
    },
    complete: function () {
      $(".btn-simpan").removeAttr("disabled");
      $(".btn-cencel").show(100);
      $(".btn-simpan").html("Update User");
    },
    error: function (xhr, ajaxOptions, thrownerror) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownerror);
    },
    success: function (response) {
      if (response.error) {
        if (response.error.nama) {
          $("#nama").addClass("is-invalid");
          $(".error_nama").html(response.error.nama);
        } else {
          $("#nama").removeClass("is-invalid");
          $(".error_nama").html("");
        }
        if (response.error.username) {
          $("#username").addClass("is-invalid");
          $(".error_username").html(response.error.username);
        } else {
          $("#username").removeClass("is-invalid");
          $(".error_username").html("");
        }
        if (response.error.password) {
          $("#password").addClass("is-invalid");
          $(".error_password").html(response.error.password);
        } else {
          $("#password").removeClass("is-invalid");
          $(".error_password").html("");
        }
        if (response.error.ulangi_password) {
          $("#ulangi_password").addClass("is-invalid");
          $(".error_ulangi_password").html(response.error.ulangi_password);
        } else {
          $("#ulangi_password").removeClass("is-invalid");
          $(".error_ulangi_password").html("");
        }
        if (response.error.hak_akses) {
          $("#hak_akses").addClass("is-invalid");
          $(".error_hak_akses").html(response.error.hak_akses);
        } else {
          $("#hak_akses").removeClass("is-invalid");
          $(".error_hak_akses").html("");
        }
        if (response.error.status) {
          $("#status").addClass("is-invalid");
          $(".error_status").html(response.error.status);
        } else {
          $("#status").removeClass("is-invalid");
          $(".error_status").html("");
        }
        if (response.error.foto) {
          $("#foto").addClass("is-invalid");
          $(".error_foto").html(response.error.foto);
        } else {
          $("#foto").removeClass("is-invalid");
          $(".error_foto").html("");
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

function change_password() {
  $("#change-password").click(function (e) {
    e.preventDefault();
    const data = $("#form-ubah-password").serialize();
    $.ajax({
      type: "post",
      url: site_url + "Users/change_password",
      data: data,
      dataType: "json",
      beforeSend: function () {
        $(".btn-ubah-password").html(
          '<i class="fa fa-spin fa-spinner"></i> loading'
        );
        $(".btn-close").hide(100);
        $(".btn-ubah-password").attr("disabled", true);
      },
      complete: function () {
        $(".btn-ubah-password").removeAttr("disabled");
        $(".btn-close").show(100);
        $(".btn-ubah-password").html("Ubah Password");
      },
      error: function (xhr, ajaxOptions, thrownerror) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownerror);
      },
      success: function (response) {
        if (response.error) {
          if (response.error.password_lama) {
            $("#password_lama").addClass("is-invalid");
            $(".error_password_lama").html(response.error.password_lama);
          } else {
            $("#password_lama").removeClass("is-invalid");
            $(".error_password_lama").html("");
          }
          if (response.error.password) {
            $("#password").addClass("is-invalid");
            $(".error_password").html(response.error.password);
          } else {
            $("#password").removeClass("is-invalid");
            $(".error_password").html("");
          }
          if (response.error.ulangi_password) {
            $("#ulangi_password").addClass("is-invalid");
            $(".error_ulangi_password").html(response.error.ulangi_password);
          } else {
            $("#ulangi_password").removeClass("is-invalid");
            $(".error_ulangi_password").html("");
          }
        } else {
          $("#ubah-password").modal("hide");
          Swal.fire({
            title: "Berhasil!",
            text: response.message,
            icon: "success",
            showConfirmButton: false,
            timer: 2100,
          });
          $("#view-content").load(window.location.href + " #view-content");
          //   setTimeout(function () {
          //     window.location.href = site_url + "Users";
          //   }, 2500);
          // $('#print_6').modal('show');
        }
      },
      error: function (xhr, ajaxOptions, thrownerror) {
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
  });
}

function hapus(kd_user) {
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Poreses ini akan menghapus data secara permanent!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: site_url + "Users/delete",
        data: {
          kd_user: kd_user,
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
  });
}

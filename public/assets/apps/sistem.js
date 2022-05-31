function hanyaAngka(event) {
  var angka = event.which ? event.which : event.keyCode;
  if (angka != 46 && angka > 31 && (angka < 48 || angka > 57)) return false;
  return true;
}

function form_edit(kode) {
  $.ajax({
    type: "post",
    url: site_url + "Sistem/form_edit",
    data: {
      id: kode,
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
    url: site_url + "Sistem/update",
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
      $(".btn-simpan").html("Update");
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
        if (response.error.owner) {
          $("#owner").addClass("is-invalid");
          $(".error_owner").html(response.error.owner);
        } else {
          $("#owner").removeClass("is-invalid");
          $(".error_owner").html("");
        }
        if (response.error.telpon) {
          $("#telpon").addClass("is-invalid");
          $(".error_telpon").html(response.error.telpon);
        } else {
          $("#telpon").removeClass("is-invalid");
          $(".error_telpon").html("");
        }
        if (response.error.email) {
          $("#email").addClass("is-invalid");
          $(".error_email").html(response.error.email);
        } else {
          $("#email").removeClass("is-invalid");
          $(".error_email").html("");
        }
        if (response.error.alamat) {
          $("#alamat").addClass("is-invalid");
          $(".error_alamat").html(response.error.alamat);
        } else {
          $("#alamat").removeClass("is-invalid");
          $(".error_alamat").html("");
        }
        if (response.error.running_text) {
          $("#running_text").addClass("is-invalid");
          $(".error_running_text").html(response.error.running_text);
        } else {
          $("#running_text").removeClass("is-invalid");
          $(".error_running_text").html("");
        }
        if (response.error.tentang) {
          $("#tentang").addClass("is-invalid");
          $(".error_tentang").html(response.error.tentang);
        } else {
          $("#tentang").removeClass("is-invalid");
          $(".error_tentang").html("");
        }
        if (response.error.logo) {
          $("#logo").addClass("is-invalid");
          $(".error_logo").html(response.error.logo);
        } else {
          $("#logo").removeClass("is-invalid");
          $(".error_logo").html("");
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
        $("#view-content").load(window.location.href + " #view-content");
        // setTimeout(function () {
        //   window.location.href = site_url + "Sistem";
        // }, 2500);
        // $('#print_6').modal('show');
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

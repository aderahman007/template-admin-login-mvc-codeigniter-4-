$(document).ready(function () {
  loadData();
  wilayah();
});
function loadData() {
  $("#datatables").DataTable({
    processing: true,
    serverSide: true,
    bDestroy: true,
    responsive: true,
    ajax: site_url + "Suplier/datatables",
    order: [],
    columns: [
      {
        data: "no",
        orderable: false,
      },
      {
        data: "kd_suplier",
      },
      {
        data: "nama_suplier",
      },
      {
        data: "email",
      },
      {
        data: "nama_kontak",
      },
      {
        data: "telpon",
      },
      {
        data: "option",
        orderable: false,
      },
    ],
    columnDefs: [
      {
        targets: [0, 6],
        className: "align-middle text-center",
      },
      {
        targets: [1, 2, 3, 4, 5],
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

function hanyaAngka(event) {
  var angka = event.which ? event.which : event.keyCode;
  if (angka != 46 && angka > 31 && (angka < 48 || angka > 57)) return false;
  return true;
}

function form_detail(kd_suplier) {
  $.ajax({
    url: site_url + "Suplier/form_detail",
    data:{kd_suplier:kd_suplier},
    dataType: "json",
    success: function (response) {
      $(".view_modal").html(response.message).show();
      $("#mymodal").modal({
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
        $("#mymodal").modal("hide");
      });
    },
  });
}

function form_add() {
  $.ajax({
    url: site_url + "Suplier/form_add",
    dataType: "json",
    success: function (response) {
      $(".view_modal").html(response.message).show();
      $("#mymodal").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
      wilayah();
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
        $("#mymodal").modal("hide");
      });
    },
  });
}

function create() {
  const data = $("#form-tambah").serialize();
  $.ajax({
    type: "post",
    url: site_url + "Suplier/create",
    data: data,
    dataType: "json",
    beforeSend: function () {
      $(".btn-simpan").html('<i class="fa fa-spin fa-spinner"></i> loading');
      $(".btn-cencel").hide(100);
      $(".btn-simpan").attr("disabled", true);
    },
    complete: function () {
      $(".btn-simpan").removeAttr("disabled");
      $(".btn-cencel").show(100);
      $(".btn-simpan").html("Tambah Suplier");
    },
    error: function (xhr, ajaxOptions, thrownerror) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownerror);
    },
    success: function (response) {
      if (response.error) {
        if (response.error.nama_suplier) {
          $("#nama_suplier").addClass("is-invalid");
          $("#error_nama_suplier").html(response.error.nama_suplier);
        } else {
          $("#nama_suplier").removeClass("is-invalid");
          $("#error_nama_suplier").html("");
        }
        if (response.error.alamat) {
          $("#alamat").addClass("is-invalid");
          $("#error_alamat").html(response.error.alamat);
        } else {
          $("#alamat").removeClass("is-invalid");
          $("#error_alamat").html("");
        }
        if (response.error.provinsi) {
          $("#provinsi").addClass("is-invalid");
          $("#error_provinsi").html(response.error.provinsi);
        } else {
          $("#provinsi").removeClass("is-invalid");
          $("#error_provinsi").html("");
        }
        if (response.error.kabupaten) {
          $("#kabupaten").addClass("is-invalid");
          $("#error_kabupaten").html(response.error.kabupaten);
        } else {
          $("#kabupaten").removeClass("is-invalid");
          $("#error_kabupaten").html("");
        }
        if (response.error.kecamatan) {
          $("#kecamatan").addClass("is-invalid");
          $("#error_kecamatan").html(response.error.kecamatan);
        } else {
          $("#kecamatan").removeClass("is-invalid");
          $("#error_kecamatan").html("");
        }
        if (response.error.desa) {
          $("#desa").addClass("is-invalid");
          $("#error_desa").html(response.error.desa);
        } else {
          $("#desa").removeClass("is-invalid");
          $("#error_desa").html("");
        }
        if (response.error.kode_pos) {
          $("#kode_pos").addClass("is-invalid");
          $("#error_kode_pos").html(response.error.kode_pos);
        } else {
          $("#kode_pos").removeClass("is-invalid");
          $("#error_kode_pos").html("");
        }
        if (response.error.nama_kontak) {
          $("#nama_kontak").addClass("is-invalid");
          $("#error_nama_kontak").html(response.error.nama_kontak);
        } else {
          $("#nama_kontak").removeClass("is-invalid");
          $("#error_nama_kontak").html("");
        }
        if (response.error.telpon) {
          $("#telpon").addClass("is-invalid");
          $("#error_telpon").html(response.error.telpon);
        } else {
          $("#telpon").removeClass("is-invalid");
          $("#error_telpon").html("");
        }
        if (response.error.email) {
          $("#email").addClass("is-invalid");
          $("#error_email").html(response.error.email);
        } else {
          $("#email").removeClass("is-invalid");
          $("#error_email").html("");
        }
      } else {
        $("#mymodal").modal("hide");
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
      $("#mymodal").modal("hide");
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
    url: site_url + "Suplier/form_edit",
    data: {
      kd_suplier: kode,
    },
    dataType: "json",
    success: function (response) {
      $(".view_modal").html(response.message).show();
      $("#mymodal").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
      wilayah();
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
        $("#mymodal").modal("hide");
      });
    },
  });
}

function update() {
  const data = $("#form-edit").serialize();
  $.ajax({
    type: "post",
    url: site_url + "Suplier/update",
    data: data,
    dataType: "json",
    beforeSend: function () {
      $(".btn-simpan").html('<i class="fa fa-spin fa-spinner"></i> loading');
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
        if (response.error.nama_suplier) {
          $("#nama_suplier").addClass("is-invalid");
          $("#error_nama_suplier").html(response.error.nama_suplier);
        } else {
          $("#nama_suplier").removeClass("is-invalid");
          $("#error_nama_suplier").html("");
        }
        if (response.error.alamat) {
          $("#alamat").addClass("is-invalid");
          $("#error_alamat").html(response.error.alamat);
        } else {
          $("#alamat").removeClass("is-invalid");
          $("#error_alamat").html("");
        }
        if (response.error.provinsi) {
          $("#provinsi").addClass("is-invalid");
          $("#error_provinsi").html(response.error.provinsi);
        } else {
          $("#provinsi").removeClass("is-invalid");
          $("#error_provinsi").html("");
        }
        if (response.error.kabupaten) {
          $("#kabupaten").addClass("is-invalid");
          $("#error_kabupaten").html(response.error.kabupaten);
        } else {
          $("#kabupaten").removeClass("is-invalid");
          $("#error_kabupaten").html("");
        }
        if (response.error.kecamatan) {
          $("#kecamatan").addClass("is-invalid");
          $("#error_kecamatan").html(response.error.kecamatan);
        } else {
          $("#kecamatan").removeClass("is-invalid");
          $("#error_kecamatan").html("");
        }
        if (response.error.desa) {
          $("#desa").addClass("is-invalid");
          $("#error_desa").html(response.error.desa);
        } else {
          $("#desa").removeClass("is-invalid");
          $("#error_desa").html("");
        }
        if (response.error.kode_pos) {
          $("#kode_pos").addClass("is-invalid");
          $("#error_kode_pos").html(response.error.kode_pos);
        } else {
          $("#kode_pos").removeClass("is-invalid");
          $("#error_kode_pos").html("");
        }
        if (response.error.nama_kontak) {
          $("#nama_kontak").addClass("is-invalid");
          $("#error_nama_kontak").html(response.error.nama_kontak);
        } else {
          $("#nama_kontak").removeClass("is-invalid");
          $("#error_nama_kontak").html("");
        }
        if (response.error.telpon) {
          $("#telpon").addClass("is-invalid");
          $("#error_telpon").html(response.error.telpon);
        } else {
          $("#telpon").removeClass("is-invalid");
          $("#error_telpon").html("");
        }
        if (response.error.email) {
          $("#email").addClass("is-invalid");
          $("#error_email").html(response.error.email);
        } else {
          $("#email").removeClass("is-invalid");
          $("#error_email").html("");
        }
      } else {
        $("#mymodal").modal("hide");
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
      $("#mymodal").modal("hide");
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

function hapus(kd_suplier) {
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
        url: site_url + "Suplier/delete",
        data: {
          kd_suplier: kd_suplier,
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

function wilayah() {
  $("#provinsi").select2({
    dropdownParent: $("#mymodal"),
    theme: "bootstrap4",
    allowClear: true,
  });

  $("#provinsi").change(function (e) {
    $.ajax({
      type: "post",
      url: site_url + "Suplier/search_kabupaten",
      data: {
        provinsi: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#kabupaten").html(response.data);
          $("#kabupaten").attr("disabled", false);
          $("#kabupaten").select2({
            dropdownParent: $("#mymodal"),
            theme: "bootstrap4",
            allowClear: true,
          });
        }
      },
    });
  });

  $("#kabupaten").change(function (e) {
    $.ajax({
      type: "post",
      url: site_url + "Suplier/search_kecamatan",
      data: {
        kabupaten: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#kecamatan").html(response.data);
          $("#kecamatan").attr("disabled", false);
          $("#kecamatan").select2({
            dropdownParent: $("#mymodal"),
            theme: "bootstrap4",
            allowClear: true,
          });
        }
      },
    });
  });

  $("#kecamatan").change(function (e) {
    $.ajax({
      type: "post",
      url: site_url + 'Suplier/search_desa',
      data: {
        kecamatan: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#desa").html(response.data);
          $("#desa").attr("disabled", false);
          $("#desa").select2({
            dropdownParent: $("#mymodal"),
            theme: "bootstrap4",
            allowClear: true,
          });
        }
      },
    });
  });
}
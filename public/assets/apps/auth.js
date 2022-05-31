$(document).ready(function() {
        login();
    });


    function login() {
        $('#form-login').submit(function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            $.ajax({
              type: "post",
              url: site_url + "Auth/login",
              data: data,
              dataType: "json",
              beforeSend: function () {
                $(".btn-login").html(
                  '<i class="fa fa-spin fa-spinner"></i> loading'
                );
                $(".btn-login").attr("disabled", true);
              },
              complete: function () {
                $(".btn-login").removeAttr("disabled");
                $(".btn-login").html("Login");
              },
              error: function (xhr, ajaxOptions, thrownerror) {
                alert(
                  xhr.status + "\n" + xhr.responseText + "\n" + thrownerror
                );
              },
              success: function (response) {
                if (response.error) {
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
                } else {
                  if (response.status == 200) {
                    Swal.fire({
                      title: "Berhasil!",
                      text: response.message,
                      icon: "success",
                      showConfirmButton: false,
                      timer: 2100,
                    });
                    setTimeout(function () {
                      window.location.href = site_url;
                    }, 2500);
                  } else {
                    Swal.fire({
                      title: "Gagal!",
                      text: response.message,
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2100,
                    });
                  }
                }
              },
              error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                  title: "Maaf Kelasalahan Server!",
                  html: `Silahkan Cek kembali Kode Error: <strong>${
                    xhr.status + "\n"
                  }</strong> `,
                  icon: "error",
                  showConfirmButton: false,
                  timer: 2100,
                });
              },
            });
        })

    }
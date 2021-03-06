let Pages_Profile = {

  init: function () {
    $(".act-upload-logo", document).on("click", Pages_Profile.onUploadLogoClick);
    $(".act-change-password", document).on("click", Pages_Profile.onChangePasswordClick);
    $(".act-export-data", document).on("click", Pages_Profile.onExportDataClick);
    $(".act-delete-account", document).on("click", Pages_Profile.onDeleteAccountClick);
  },

  onUploadLogoClick: function() {
    let file = document.createElement("input");
    file.type = "file";
    file.accept = "image/x-png,image/jpeg";
    file.addEventListener('change', function () {
      let fd = new FormData();
      let files = file.files;
      if (files.length > 0) {
        fd.append('logo', files[0]);
        $.ajax({
          method: "POST",
          url: "/profile/logo",
          data: fd,
          contentType: false,
          processData: false,
          success: function (data) {
            $('#Logo', document).attr('src', data.logo);
            $('.avatar-img', document).attr('src', data.logo);
          },
        });
      }
    });
    file.click();
  },

  onChangePasswordClick: function () {
    dialog({
      title: 'Zmień hasło',
      load: {
        url: "/profile/changepassword"
      },
      save: {
        url: "/profile/changepassword",
        callback: function(dialogRef, data) {
          if(data.success) {
            swal("Gotowe!", "Twóje hasło zostało zmienione", {
              icon: "success",
              buttons: {
                confirm: {
                  className: 'btn btn-primary'
                }
              },
            });
          }
          else {
            swal("Coś poszło nie tak...", "Spróbuj ponownie później.", {
              icon: "error",
              buttons: {
                confirm: {
                  className: 'btn btn-danger'
                }
              },
            });
          }
        }
      },
      buttons: [
        { label: 'Anuluj', class: 'btn btn-light act-close' },
        { label: 'Zapisz', class: 'btn btn-primary act-save' }
      ],
    });
  },

  onExportDataClick: function () {
    dialog({
      title: 'Eksportuj dane',
      message: '...'
    });
  },

  onDeleteAccountClick: function () {
    dialog({
      title: 'Usuń konto',
      message: function() {
        let html = [];
        html.push('<form>');
        html.push('<div class="form-group row">');
        html.push('  <label for="current_password" class="col-form-label col-md-2">Hasło</label>');
        html.push('  <div class="col-md-10">');
        html.push('    <input type="password" id="current_password" class="form-control" name="current_password"/>');
        html.push('  </div>');
        html.push('</div>');
        html.push('</form>');
        return html.join('\r\n');
      },
      class: 'bg-danger',
      save: {
        url: "/profile/delete",
        callback: function() {
          swal("Twoje konto zostało usunięte!", 'Za chwilę zostaniesz przekierowany na stronę logowania.', {
            icon: "success",
            buttons: {},
          }).then(function(){
            window.location.href = "/";
          });
          setTimeout(function(){
            window.location.href = "/";
          }, 5000);
        }
      },
      buttons: [
        { label: 'Anuluj', class: 'btn btn-light act-close' },
        { label: 'Usuń', class: 'btn btn-danger act-save' }
      ],
    });
  },

};

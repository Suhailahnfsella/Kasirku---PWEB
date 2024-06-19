<!doctype html>
<html lang="en">
<?php include 'header.php'; ?>
<body>
  <div class="container" style="margin-top: 50px;">
    <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
      <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
        <?php include 'navbaradmin.php'; ?>
        <div class="card text-center" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom: 20px;">
          <div class="card-body d-flex flex-row align-items-center" style="padding: 3% 10%;">
            <div class="col-6">
              <div class="mb-3">
                <h6 style="color: #112D55; font-weight:bold">Nama Admin</h6>
                <p><?php echo $nama_admin; ?></p>
              </div>
              <div class="mb-3">
                <h6 style="color: #112D55; font-weight:bold">Username Admin:</h6>
                <p><?php echo $username_admin; ?></p>
              </div>
              <div class="mb-4">
                <h6 style="color: #112D55; font-weight:bold">Email Admin:</h6>
                <p><?php echo $email_admin; ?></p>
              </div>
              <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" style="margin-left:25%; margin-right:25%; font-size: 14px" data-bs-toggle="modal" data-bs-target="#ModalUbahProfil" data-passwordadmin="<?php echo $password_admin; ?>">Edit Profil</button>
                <a href="/kantinku/logoutadmin" class="btn btn-danger" style="margin-left:25%; margin-right:25%; font-size: 14px">Keluar</a>
              </div>
            </div>
            <div class="col-6">
              <img src="/kantinku/views/assets/admin.jpg" alt="" width="80%" class="mt-4 mb-4 float-end">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ubah Profil -->
  <div class="modal fade" id="ModalUbahProfil" tabindex="-1" aria-labelledby="ModalUbahProfil" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalUbahProfil">Ubah Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="ubahProfilForm">
            <div class="mb-3">
              <label for="Username">Username</label>
              <input type="text" class="form-control" id="Username" name="Username" value="<?php echo $username_admin; ?>"></input>
            </div>
            <div class="mb-3">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $email_admin; ?>"></input>
            </div>
            <div class="mb-3">
              <label for="Password">Password</label>
              <input type="password" class="form-control" id="Password" name="Password" oninput="enableConfirmPassword()"></input>
            </div>  
            <div class="mb-3">
              <label for="konfirmPassword">Konfirmasi Password</label>
              <input type="password" class="form-control" id="konfirmPassword" name="konfirmPassword" disabled></input>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
          <button class="btn btn-primary" id="btnUbahProfil" type="button" data-bs-dismiss="modal">Simpan</button>
        </div>
      </div>
    </div>
  </div>  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
  <script>
    function enableConfirmPassword() {
      var passwordInput = document.getElementById('Password');
      var confirmPasswordInput = document.getElementById('konfirmPassword');

      if (passwordInput.value.trim() !== '') {
        confirmPasswordInput.disabled = false;
      } else {
        confirmPasswordInput.disabled = true;
        confirmPasswordInput.value = '';
      }
    }

    $(document).ready(function() {
      $('[data-bs-target="#ModalUbahProfil"]').click(function() {
          var passwordAdmin = $(this).data('passwordadmin');
          $('#ModalUbahProfil').data('passwordadmin', passwordAdmin);
      });

      $('#btnUbahProfil').off('click').on('click', function(event) {
        event.preventDefault(); 

        var usernameAdmin = $('#Username').val();
        var emailAdmin = $('#Email').val();
        var passwordAdmin = $('#Password').val(); 
        var konfirmPasswordAdmin = $('#konfirmPassword').val(); 

        function isValidEmail(email) {
          var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return emailPattern.test(email);
        }

        if (emailAdmin.trim() == '' || !isValidEmail(emailAdmin)) {
          alert('Masukkan Email dengan benar!');
        } else if (usernameAdmin.trim() == '') {
          alert('Username tidak boleh kosong!');
        } else {
          if (passwordAdmin.trim() != '') {
            if (passwordAdmin.trim().length >= 8 && /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/.test(passwordAdmin))  {
              if (passwordAdmin != konfirmPasswordAdmin) {
                alert("Konfirmasi Password Salah!")
              } else {
                var hashedPassword = CryptoJS.SHA256(passwordAdmin).toString();

                var formData = new FormData();
                formData.append('username_admin', usernameAdmin);
                formData.append('email_admin', emailAdmin);
                formData.append('password_admin', hashedPassword);
                
                $.ajax({
                  url: "/kantinku/edit_admin",
                  type: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(data) {
                    alert(data.message);
                    if (data.success) {
                      $('#Username').val('');
                      $('#Email').val('');
                      $('#Password').val('');
                      $('#konfirmPassword').val('');
                      window.location.reload();
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error('Kesalahan saat mengunggah file:', error);
                  }
                });
              }
            } else {
              alert("Password minimal 8 karakter dengan variasi huruf kapital, kecil, angka, dan regex!")
            }
          } else {
            var formData = new FormData();
            formData.append('username_admin', usernameAdmin);
            formData.append('email_admin', emailAdmin);
            formData.append('password_admin', $('#ModalUbahProfil').data('passwordAdmin'));
            
            $.ajax({
              url: "/kantinku/edit_admin",
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {
                alert(data.message);
                if (data.success) {
                  $('#Username').val('');
                  $('#Email').val('');
                  $('#Password').val('');
                  $('#konfirmPassword').val('');
                  window.location.reload();
                }
              }
            });
          }
        }
      });
    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

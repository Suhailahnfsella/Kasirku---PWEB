<!doctype html>
<html lang="en">
<?php include 'header.php'; ?>
  <body>
    <div class="container" style="height: 90vh; margin-top: 30px;">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center mb-3 mb-md-0">
                <div class="card text-center" style="width: 18rem; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin-bottom: 20px">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title" style="color: #7d899b; font-size: 16px">Masuk sebagai</br><span style="color: #112D55; font-size: 24px; font-weight: bold;">Pegawai</span></h5>
                        <img src="/kantinku/views/assets/pegawai.jpg" alt="" width="200px" class="mt-4 mb-4">
                        <form id="loginForm" class="mt-4 mb-4" style="width: 240px;">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Username" name="Username" placeholder="Nama Pengguna" style="font-size: 14px;"></input>
                            </div>     
                            <div class="mb-3">
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Kata Sandi" style="font-size: 14px;"></input>
                            </div>
                            <button class="btn btn-vertical-align mt-4" id="btnLoginPegawai" style="background-color: #112D55; color: white;">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btnLoginPegawai').click(function() {
                var username = $('#Username').val();
                var password = $('#Password').val();
                var hashedPassword = CryptoJS.SHA256(password).toString();

                var formData = new FormData();
                formData.append('username', username);
                formData.append('password', password);

                $.ajax({
                    url: "/kantinku/setLoginPegawai",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            window.location.href = '/kantinku/dashboard_pegawai';
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Kesalahan saat mengunggah file:', error);
                    }
                });
            });
        });
    </script>
  </body>
</html>

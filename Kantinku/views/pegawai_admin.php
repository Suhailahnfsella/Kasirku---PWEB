<!doctype html>
<html lang="en">
<?php include 'header.php'; ?>
  <body>
  <div class="container" style="margin-top : 50px;">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
                <?php include 'navbaradmin.php'; ?>
                <div class="card text-center" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom : 20px">
                    <button class="btn btn-primary" style="width: 100px; margin : 20px 20px 0px 20px" data-bs-toggle="modal" data-bs-target="#ModalTambahPegawai">Tambah</button>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4" style="width: 100%;">
                            <?php foreach ($pegawaies as $pegawai): ?>
                                <div class="col" style="width: 24%; min-width: 200px; font-size : 12px">            
                                    <div class="card card-container">
                                        <div class="status-label <?php if($pegawai['status_pegawai'] == 1) { echo 'bg-success';} else {echo 'bg-danger';}; ?>" data-idpegawai=<?php echo $pegawai['id_pegawai']; ?>><?php if($pegawai['status_pegawai'] == 1) { echo 'Aktif';} else {echo 'Non Aktif';}; ?></div>
                                        <div class="card-body">
                                            <h5 class="card-title mt-4"><?php echo $pegawai['nama_pegawai']; ?></h5>
                                            <p class="card-text text-danger" style="font-weight: 700; font-size: 14px"><?php echo $pegawai['username_pegawai']; ?></p>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-danger" style="margin: 3px;" data-bs-toggle="modal" data-bs-target="#ModalHapusPegawai" data-idpegawai="<?php echo $pegawai['id_pegawai']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="ModalTambahPegawai" tabindex="-1" aria-labelledby="ModalTambahPegawai" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-l modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahPegawai">Tambah Pegawai Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="NamaPegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" id="NamaPegawai" name="NamaPegawai"></input>
                        </div>   
                        <div class="mb-3">
                            <label for="UsernamePegawai">Username Pegawai</label>
                            <input type="text" class="form-control" id="UsernamePegawai" name="UsernamePegawai"></input>
                        </div>   
                        <div class="mb-3">
                            <label for="PasswordPegawai">Password Pegawai</label>
                            <input type="password" class="form-control" id="PasswordPegawai" name="PasswordPegawai"></input>
                        </div>   
                        <div class="mb-3">
                            <label for="PasswordPegawai2">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="PasswordPegawai2" name="PasswordPegawai2"></input>
                        </div>   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary" id="btnTambahPegawai" data-bs-dismiss="modal">Tambah</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#btnTambahPegawai').off('click').on('click', function() {
                            var nama_pegawai = $('#NamaPegawai').val();
                            var username_pegawai = $('#UsernamePegawai').val();
                            var password_pegawai = $('#PasswordPegawai').val();
                            var password_pegawai2 = $('#PasswordPegawai2').val();

                            if (nama_pegawai.trim() == '') {
                                alert('Nama pegawai tidak boleh kosong!');
                            } else if (username_pegawai.trim() == '') {
                                alert('Username pegawai tidak boleh kosong!');
                            } else if (password_pegawai.trim() == '') {
                                alert('Password pegawai tidak boleh kosong!');
                            } else if (password_pegawai.trim() != password_pegawai2.trim()) {
                                alert('Konfirmasi password berbeda!');
                            } else {
                                var hashedPassword = CryptoJS.SHA256(password_pegawai).toString();

                                var formData = new FormData();
                                formData.append('nama_pegawai', nama_pegawai);
                                formData.append('username_pegawai', username_pegawai);
                                formData.append('password_pegawai', hashedPassword);
                                
                                $.ajax({
                                    url: "/kantinku/tambah_pegawai",
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        alert(data.message);
                                        if (data.success) {
                                            $('#NamaPegawai').val('');
                                            $('#UsernamePegawai').val('');
                                            $('#PasswordPegawai').val('');
                                            $('#PasswordPegawai2').val('');
                                            window.location.reload();
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Kesalahan saat mengunggah file:', error);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pegawai -->
    <div class="modal fade" id="ModalHapusPegawai" aria-hidden="true" aria-labelledby="ModalHapusPegawai" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalHapusPegawai">Yakin akan menghapus?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal" id="btnHapus">Yakin</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function() {
                $('.btn-danger').click(function() {
                    var id_pegawai = $(this).data('idpegawai');

                    $('#btnHapus').click(function() {
                        var formData = new FormData();
                        formData.append('id_pegawai', id_pegawai);

                        $.ajax({
                            url: "/kantinku/hapus_pegawai",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                alert(data.message);
                                if (data.success) {
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Kesalahan saat mengunggah file:', error);
                            }
                        });
                    });
                });

                $('.status-label').click(function() {
                    var statusElement = $(this);
                    var currentStatus = statusElement.text().trim();
                    var newStatus = currentStatus === 'Aktif' ? 'Non Aktif' : 'Aktif';
                    var newStatusClass = currentStatus === 'Aktif' ? 'bg-danger' : 'bg-success';
                    var id_pegawai = statusElement.data('idpegawai');
                    var newStatusId = currentStatus === 'Aktif' ? 2 : 1;

                    statusElement.text(newStatus).removeClass('bg-success bg-danger').addClass(newStatusClass);
                    
                    var formData = new FormData();
                    formData.append('id_pegawai', id_pegawai);
                    formData.append('id_status', newStatusId);

                    $.ajax({
                        url: "/kantinku/edit_pegawai",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            window.location.href = '/kantinku/kelola_pegawai';
                        },
                        error: function(xhr, status, error) {
                            console.error('Kesalahan saat mengunggah file:', error);
                        }
                    });
                })
            });
            </script>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>

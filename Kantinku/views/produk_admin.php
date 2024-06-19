<!doctype html>
<html lang="en">
<?php include 'header.php'; ?>
  <body>
  <div class="container" style="margin-top : 50px;">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
                <?php include 'navbaradmin.php'; ?>
                <div class="card text-center" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom : 20px">
                    <button class="btn btn-primary" style="width: 100px; margin : 20px 20px 0px 20px" data-bs-toggle="modal" data-bs-target="#ModalTambahProduk">Tambah</button>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4" style="width: 100%;">
                            <?php foreach ($products as $product): ?>
                                <div class="col" style="width: 24%; min-width: 200px; font-size : 12px">            
                                    <div class="card card-container">
                                        <div class="category-label"><?php echo $product['nama_kategori']; ?></div>
                                        <img src="/kantinku/views/assets/produk_img/<?php echo $product['foto_produk']; ?>" class="card-img-top" alt="..." style="margin: 20px 20px 0px 20px; width: 80%; height: 80%; border-radius: 10px">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product['nama_produk']; ?></h5>
                                            <p class="card-text text-danger" style="font-weight: 700; font-size: 14px">Rp. <?php echo $product['harga_produk']; ?></p>
                                            <p class="card-text text-muted" style="font-size: 12px">Stok: <?php echo $product['stok_produk']; ?></p>
                                            <p class="card-text" style="font-size: 12px"><?php echo $product['keterangan_produk']; ?></p>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-danger" style="margin: 3px;" data-bs-toggle="modal" data-bs-target="#ModalHapusProduk" data-idproduk="<?php echo $product['id_produk']; ?>" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                    </svg>
                                                </button>
                                                <button class="btn btn-warning" style="margin: 3px;" data-bs-toggle="modal" data-bs-target="#ModalEditProduk" data-idproduk="<?php echo $product['id_produk']; ?>" data-namaproduk="<?php echo $product['nama_produk']; ?>" data-hargaproduk="<?php echo $product['harga_produk']; ?>" data-stokproduk="<?php echo $product['stok_produk']; ?>" data-fotoproduk="<?php echo $product['foto_produk']; ?>" data-keteranganproduk="<?php echo $product['keterangan_produk']; ?>" data-idkategori="<?php echo $product['id_kategori']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
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

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="ModalTambahProduk" tabindex="-1" aria-labelledby="ModalTambahProduk" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-l modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahProduk">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Pilih Kategori Produk</label>
                            <div class="input-group">
                            <select class="form-select" id="pilihKategoriProduk" aria-label="Example select with button addon">
                            </select>
                                <button class="btn btn-outline-primary" type="button" data-bs-target="#ModalTambahKategori" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Nama">Nama Produk</label>
                            <input type="text" class="form-control" id="Nama" name="Nama"></input>
                        </div>
                        <div class="mb-3">
                            <label for="Harga">Harga</label>
                            <input type="number" class="form-control" id="Harga" name="Harga"></input>
                        </div>
                        <div class="mb-3">
                            <label for="Stok">Stok</label>
                            <input type="number" class="form-control" id="Stok" name="Stok"></input>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="col-form-label">Keterangan Produk :</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto">Foto Produk</label>
                            <input class="form-control" name="foto" type="file" id="formFileFotoProduk">
                        </div>
                        <div>
                            <img id="image" src="" alt="Image for cropping" width="100%">
                        </div>
                        <div style="margin-top: 20px;">
                            <h6>Preview Hasil Crop:</h6>
                            <img id="preview" src="" alt="Preview" width="100%">
                        </div>     
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-warning" id="cropButton">Pangkas</button>
                    <button class="btn btn-primary" id="btnTambahProduk" data-bs-dismiss="modal">Tambah</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
                <script>
                    $(document).ready(function() {
                        let cropper;
                        let croppedImage;

                        $('#formFileFotoProduk').change(function(e) {
                            const files = e.target.files;
                            if (files.length > 0) {
                                const file = files[0];
                                const fileType = file['type'];
                                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                
                                if (!validImageTypes.includes(fileType)) {
                                    alert("File yang diunggah bukan gambar. Silakan unggah file gambar (jpeg, png, gif).");
                                    return;
                                }

                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    $('#image').attr('src', event.target.result).show();
                                    if (cropper) {
                                        cropper.destroy();
                                    }
                                    cropper = new Cropper(document.getElementById('image'), {
                                        aspectRatio: 1,
                                        viewMode: 1,
                                    });
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        $('#cropButton').click(function() {
                            if (cropper) {
                                const canvas = cropper.getCroppedCanvas({
                                    width: 300,
                                    height: 300,
                                });
                                canvas.toBlob(function(blob) {
                                    croppedImage = blob;
                                    const url = URL.createObjectURL(blob);
                                    $('#preview').attr('src', url).show();
                                });
                            }
                        });

                        function getAllKategori() {
                            $.ajax({
                                url: "/kantinku/get_kategori",
                                type: "GET",
                                success: function(response) {
                                    updateKategoriOptions(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error("Terjadi kesalahan: " + error);
                                }
                            });
                        }

                        function updateKategoriOptions(data) {
                            var selectElement = document.getElementById("pilihKategoriProduk");
                            selectElement.innerHTML = '<option value="" disabled selected>Pilih kategori produk</option>';

                            // Langsung gunakan respons JSON tanpa parsing kembali
                            data.forEach(function(item) {
                                var option = document.createElement("option");
                                option.text = item.nama_kategori;
                                option.value = item.id_kategori;
                                selectElement.appendChild(option);
                            });
                        }

                        $('#btnTambahProduk').off('click').on('click', function() {
                            var nama_produk = $('#Nama').val();
                            var harga_produk = $('#Harga').val();
                            var stok_produk = $('#Stok').val();
                            var keterangan_produk = $('#keterangan').val();
                            var foto_produk = $('#formFileFotoProduk').val();
                            var id_kategori = $('#pilihKategoriProduk').val();

                            if (nama_produk.trim() == '') {
                                alert('Nama produk tidak boleh kosong!');
                            } else if (harga_produk.trim() <= 0) {
                                alert('Harga produk tidak boleh kosong!');
                            } else if (stok_produk.trim() <= 0) {
                                alert('Stok produk tidak boleh kosong!');
                            } else if (keterangan_produk.trim() == '') {
                                alert('Keterangan produk tidak boleh kosong!');
                            } else if (foto_produk.trim() == '') {
                                alert('Foto produk tidak boleh kosong!');
                            } else if (id_kategori == null) {
                                alert('Kategori harus dipilih!');
                            } else {
                                var formData = new FormData();
                                formData.append('nama_produk', nama_produk);
                                formData.append('harga_produk', harga_produk);
                                formData.append('stok_produk', stok_produk);
                                formData.append('keterangan_produk', keterangan_produk);
                                formData.append('foto_produk', $('#formFileFotoProduk')[0].files[0]);
                                formData.append('id_kategori', id_kategori);
                                formData.append('action', 'tambahProduk');
                                
                                $.ajax({
                                    url: "/kantinku/tambah_produk",
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        alert("Produk baru berhasil ditambahkan!");

                                        $('#ModalTambahProduk').modal('hide');
                                        $('#Nama').val('');
                                        $('#Harga').val('');
                                        $('#Stok').val('');
                                        $('#keterangan').val('');
                                        $('#formFileFotoProduk').val('');
                                        $('#pilihKategoriProduk').val('');
                                        $('#pilihKategoriProduk').html('<option value="" disabled selected>Pilih kategori produk</option>');
                                        $('#foto').attr('src', '');
                                        $('#image').attr('src', '');
                                        $('#preview').attr('src', '');

                                        window.location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Kesalahan saat mengunggah file:', error);
                                    }
                                });
                            }
                        });
                
                        getAllKategori();
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="ModalEditProduk" tabindex="-1" aria-labelledby="ModalEditProduk" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-l modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditProdukTitle">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" hidden>
                            <input type="number" class="form-control" id="idProduk" name="idProduk">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Pilih Kategori Produk</label>
                            <div class="input-group">
                                <select class="form-select" id="pilihKategoriProdukEdit" aria-label="Example select with button addon">
                                </select>
                                <button class="btn btn-outline-primary" type="button" data-bs-target="#ModalTambahKategori" data-bs-toggle="modal" data-bs-dismiss="modal">Tambah</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="namaProduk">Nama Produk</label>
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                        </div>
                        <div class="mb-3">
                            <label for="hargaProduk">Harga</label>
                            <input type="number" class="form-control" id="hargaProduk" name="hargaProduk">
                        </div>
                        <div class="mb-3">
                            <label for="stokProduk">Stok</label>
                            <input type="number" class="form-control" id="stokProduk" name="stokProduk">
                        </div>
                        <div class="mb-3">
                            <label for="keteranganProduk" class="col-form-label">Keterangan Produk :</label>
                            <textarea class="form-control" id="keteranganProduk" name="keteranganProduk" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto">Foto Produk</label>
                            <input class="form-control" name="foto" type="file" id="formFileFotoProdukEdit">
                        </div>
                        <div>
                            <img id="imageProduk" src="" alt="Image for cropping" width="100%">
                        </div>
                        <div style="margin-top: 20px;">
                            <h6>Preview Hasil Crop:</h6>
                            <img id="previewProduk" src="" alt="Preview" width="100%">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-warning" id="cropButtonEdit">Pangkas</button>
                    <button class="btn btn-primary" id="btnEditProduk" data-bs-dismiss="modal">Simpan Perubahan</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                function getAllKategori(selectedId) {
                    $.ajax({
                        url: "/kantinku/get_kategori",
                        type: "GET",
                        success: function(response) {
                            updateKategoriOptions(response, selectedId);
                        },
                        error: function(xhr, status, error) {
                            console.error("Terjadi kesalahan: " + error);
                        }
                    });
                }

                function updateKategoriOptions(data, selectedId) {
                    var selectElement = document.getElementById("pilihKategoriProdukEdit");

                    selectElement.innerHTML = '';

                    data.forEach(function(item) {
                        var option = document.createElement("option");
                        option.text = item.nama_kategori;
                        option.value = item.id_kategori;

                        if (item.id_kategori == selectedId) {
                            option.selected = true;
                        }

                        selectElement.appendChild(option);
                    });
                }

                $('.btn-warning').click(function() {
                    var id_produk = $(this).data('idproduk');
                    var nama_produk = $(this).data('namaproduk');
                    var harga_produk = $(this).data('hargaproduk');
                    var stok_produk = $(this).data('stokproduk');
                    var fotoproduk = $(this).data('fotoproduk');
                    var keterangan_produk = $(this).data('keteranganproduk');
                    var id_kategori = $(this).data('idkategori');

                    $('#idProduk').val(id_produk);
                    $('#namaProduk').val(nama_produk);
                    $('#hargaProduk').val(harga_produk);
                    $('#stokProduk').val(stok_produk);
                    $('#keteranganProduk').val(keterangan_produk);
                    $('#previewProduk').attr('src', '/kantinku/views/assets/produk_img/' + fotoproduk).show();

                    var id_kategori = $(this).data('idkategori');

                    getAllKategori(id_kategori);

                    let cropper;
                    let croppedImage;

                    $('#formFileFotoProdukEdit').change(function(e) {
                        const files = e.target.files;
                        if (files.length > 0) {
                            const file = files[0];
                            const fileType = file['type'];
                            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            
                            if (!validImageTypes.includes(fileType)) {
                                alert("File yang diunggah bukan gambar. Silakan unggah file gambar (jpeg, png, gif).");
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(event) {
                                $('#imageProduk').attr('src', event.target.result).show();
                                if (cropper) {
                                    cropper.destroy();
                                }
                                cropper = new Cropper(document.getElementById('imageProduk'), {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    $('#cropButtonEdit').click(function() {
                        if (cropper) {
                            const canvas = cropper.getCroppedCanvas({
                                width: 300,
                                height: 300,
                            });
                            canvas.toBlob(function(blob) {
                                croppedImage = blob;
                                const url = URL.createObjectURL(blob);
                                $('#previewProduk').attr('src', url).show();

                                $('#idProduk').val(id_produk);
                                $('#namaProduk').val(nama_produk);
                                $('#hargaProduk').val(harga_produk);
                                $('#stokProduk').val(stok_produk);
                                $('#keteranganProduk').val(keterangan_produk);
                                $('#imageProduk').attr('src', url).show();

                                getAllKategori(id_kategori);
                            });
                        }
                        $(this).removeAttr('data-bs-dismiss');
                    });

                    $('#btnEditProduk').off('click').on('click', function() {
                        var id_produkval = $('#idProduk').val();
                        var nama_produkval = $('#namaProduk').val();
                        var harga_produkval = $('#hargaProduk').val();
                        var stok_produkval = $('#stokProduk').val();
                        var keterangan_produkval = $('#keteranganProduk').val();
                        var foto_produkval = $('#formFileFotoProdukEdit').val();
                        var id_kategorival = $('#pilihKategoriProdukEdit').val();

                        if (nama_produkval.trim() == '') {
                            alert('Nama produk tidak boleh kosong!');
                        } else if (harga_produkval.trim() <= 0) {
                            alert('Harga produk tidak boleh kosong!');
                        } else if (stok_produkval.trim() <= 0) {
                            alert('Stok produk tidak boleh kosong!');
                        } else if (keterangan_produkval.trim() == '') {
                            alert('Keterangan produk tidak boleh kosong!');
                        } else if (id_kategorival == null) {
                            alert('Kategori harus dipilih!');
                        } else {
                            var formData = new FormData();
                            formData.append('nama_produk', nama_produkval);
                            formData.append('harga_produk', harga_produkval);
                            formData.append('stok_produk', stok_produkval);
                            formData.append('keterangan_produk', keterangan_produkval);
                            formData.append('id_kategori', id_kategorival);
                            formData.append('id_produk', id_produkval);
                            
                            if ($('#formFileFotoProdukEdit')[0].files.length > 0) {
                                var file = $('#formFileFotoProdukEdit')[0].files[0];
                                formData.append('ada_foto_produk', file);
                                formData.append('foto_produk_name', file.name);
                            } else {
                                formData.append('foto_produk', fotoproduk);
                            }
                            
                            $.ajax({
                                url: "/kantinku/update_produk",
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    alert("Produk berhasil diubah!");
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Kesalahan saat mengunggah file:', error);
                                }
                            });
                        }
                    });
                });
            })
        </script>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="ModalTambahKategori" aria-hidden="true" aria-labelledby="ModalTambahKategori" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalTambahKategori">Tambah Kategori Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Kategori baru</label>
                        <textarea class="form-control" id="kategoriBaru"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal">Batal</button>
            <button type="button" id="btnTambahKategori" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#btnTambahKategori').click(function() {
                        var kategoriProduk = $('#kategoriBaru').val();
                        
                        if (kategoriProduk.trim() == '') {
                            alert("Kategori tidak boleh kosong!")
                        } else {
                            var formData = new FormData();
                            formData.append('nama_kategori', kategoriProduk);

                            $.ajax({
                                url: "/kantinku/tambah_kategori",
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    alert(data.message);
                                    if (data.success) {
                                        $('#kategoriBaru').val('');
                                        window.location.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Kesalahan saat mengunggah file:', error);
                                }
                            });
                        }
                    })
                });
            </script> 
        </div>
        </div>
    </div>

    <!-- Modal Hapus Produk -->
    <div class="modal fade" id="ModalHapusProduk" aria-hidden="true" aria-labelledby="ModalHapusProduk" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalHapusProduk">Yakin akan menghapus?</h5>
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
                    var id_produk = $(this).data('idproduk');

                    $('#btnHapus').click(function() {
                        var formData = new FormData();
                        formData.append('id_produk', id_produk);

                        $.ajax({
                            url: "/kantinku/hapus_produk",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data.success) {
                                    window.location.reload();
                                } else {
                                    alert(data.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Kesalahan saat mengunggah file:', error);
                            }
                        });
                    });
                });
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

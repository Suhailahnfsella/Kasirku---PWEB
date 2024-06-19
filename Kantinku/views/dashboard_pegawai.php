<!doctype html>
<html lang="en">
  <?php include 'header.php'; ?>
  <body>
  <div class="container" style="margin-top : 50px;">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
                <?php include 'navbarpegawai.php'; ?>
                <div class="card text-center" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-top-left-radius: 0px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom : 20px">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="container" style="margin-top: 50px;">
                            <div class="row">
                                <?php foreach ($data_penjualan as $penjualan): ?>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header" style="background-color: #112D55; color: white">
                                            Nomor Antrian: <?php echo $penjualan['id_penjualan']; ?>
                                        </div>
                                        <div class="card-body">
                                            <p class="labelantrian2 <?php if($penjualan['id_status'] == 1) {echo 'bg-danger';} else {echo 'bg-success';} ?>" data-idpenjualan=<?php echo $penjualan['id_penjualan']; ?> data-usernamepegawai=<?php echo $_SESSION['username_pegawai']; ?>><?php if($penjualan['id_status'] == 1) {echo 'Dalam Antrian';} else {echo 'Selesai';} ?></p>
                                            <h5 class="card-title" style="font-weight: bold; color: #112D55"><?php echo $penjualan['nama_pembeli']; ?></h5>
                                            <p style="color:green; font-weight:bold;">Rp. <?php echo $penjualan['total']; ?></p>
                                            <p style="font-size: 12px; font-weight:500; color: red;">Catatan : <?php if($penjualan['catatan'] == ''){echo '-';} else {echo $penjualan['catatan'];}  ?></p>
                                            <h6 class="card-title mt-4">Detail Pesanan</h6>
                                            <div class="table-responsive">
                                                <table class="table" style="font-size: 12px;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Nama Produk</th>
                                                            <th scope="col">Jumlah</th>
                                                            <th scope="col">Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $index = 0;
                                                        foreach ($detail_penjualan as $detail): 
                                                            if ($detail['id_penjualan'] == $penjualan['id_penjualan']) { ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo ++$index; ?></th>
                                                                    <td><?php echo $detail['nama_produk']; ?></td>
                                                                    <td><?php echo $detail['jumlah']; ?></td>
                                                                    <td>Rp. <?php echo $detail['harga_produk']; ?></td>
                                                                </tr>
                                                        <?php } endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.labelantrian2').click(function() {
                var statusElement = $(this);
                var currentStatus = statusElement.text().trim();
                var newStatus = currentStatus === 'Dalam Antrian' ? 'Selesai' : alert('Pesanan sudah selesai!');
                var id_penjualan = statusElement.data('idpenjualan');
                var username_pegawai = statusElement.data('usernamepegawai');
                var newStatusId = currentStatus === 'Dalam Antrian' ? 2 : 2;
                
                var formData = new FormData();
                formData.append('id_penjualan', id_penjualan);
                formData.append('id_status', newStatusId);
                formData.append('username_pegawai', username_pegawai);

                $.ajax({
                    url: "/kantinku/edit_penjualan",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        window.location.href = '/kantinku/dashboard_pegawai';
                    },
                    error: function(xhr, status, error) {
                        console.error('Kesalahan saat mengunggah file:', error);
                    }
                });
            })
        })
    </script>
    </body>
</html>
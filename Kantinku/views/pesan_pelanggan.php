<!doctype html>
<html lang="en">
  <?php include 'header.php'; ?>
  <body>
    <div class="container" style="margin-top: 50px;">
      <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
          <?php include 'navbarpelanggan.php'; ?>
          <div class="card text-center" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin-bottom: 20px;">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="row" style="width: 100%;">
                <div class="col-md-6" style="border-right: 1px solid #ddd;">
                  <h5 class="card-title">Struk Pembelian</h5>
                  <div id="billing" style="border: 1px solid #ddd; padding: 10px; border-radius: 10px;">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nama Produk</th>
                          <th scope="col">Jumlah</th>
                          <th scope="col">Total Harga</th>
                        </tr>
                      </thead>
                      <tbody id="billing-items"></tbody>
                    </table>
                    <div id="total-belanja" style="padding-top: 10px; margin-top: 10px; font-weight: bold; color: green">Total: Rp. 0</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h5 class="card-title">Form Pemesanan</h5>
                  <form id="orderForm">
                    <div class="mb-3">
                      <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                      <input type="text" class="form-control" id="namaPemesan" name="namaPemesan" required>
                    </div>
                    <div class="mb-3">
                      <label for="catatan" class="form-label">Catatan</label>
                      <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                    </div>
                    <button type="submit" id="btnPesan" class="btn btn-primary">Pesan</button>
                  </form>
                </div>
              </div>
              <div class="row row-cols-1 row-cols-md-2 g-4 mb-4 mt-4" style="width: 100%;">
                <?php foreach ($products as $product): ?>
                  <div class="col" style="width: 24%; min-width: 200px; font-size: 12px;">
                    <div class="card card-container">
                      <div class="category-label"><?php echo $product['nama_kategori']; ?></div>
                      <img src="/kantinku/views/assets/produk_img/<?php echo $product['foto_produk']; ?>" class="card-img-top" alt="..." style="margin: 20px 20px 0px 20px; width: 80%; height: 80%; border-radius: 10px;">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $product['nama_produk']; ?></h5>
                        <p class="card-text text-danger" style="font-weight: 700; font-size: 14px;">Rp. <?php echo $product['harga_produk']; ?></p>
                        <p class="card-text text-muted" style="font-size: 12px;">Stok: <?php echo $product['stok_produk']; ?></p>
                        <p class="card-text" style="font-size: 12px;"><?php echo $product['keterangan_produk']; ?></p>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn-small bg-primary btn-decrement" data-idproduk="<?php echo $product['id_produk']; ?>" style="margin: 3px;">-</button>
                            <span class="product-quantity" data-idproduk="<?php echo $product['id_produk']; ?>">0</span>
                            <button class="btn-small bg-primary btn-increment" data-idproduk="<?php echo $product['id_produk']; ?>" style="margin: 3px;">+</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const incrementButtons = document.querySelectorAll('.btn-increment');
        const decrementButtons = document.querySelectorAll('.btn-decrement');
        const quantities = {};
        let totalBelanja = 0;

        incrementButtons.forEach(button => {
          button.addEventListener('click', function() {
            const productId = this.getAttribute('data-idproduk');
            if (!quantities[productId]) quantities[productId] = 0;
            quantities[productId]++;
            updateQuantityDisplay(productId);
            updateBilling();
            saveQuantitiesToLocalStorage();
          });
        });

        decrementButtons.forEach(button => {
          button.addEventListener('click', function() {
            const productId = this.getAttribute('data-idproduk');
            if (!quantities[productId]) quantities[productId] = 0;
            if (quantities[productId] > 0) quantities[productId]--;
            updateQuantityDisplay(productId);
            updateBilling();
            saveQuantitiesToLocalStorage();
          });
        });

        function updateQuantityDisplay(productId) {
          document.querySelector(`.product-quantity[data-idproduk="${productId}"]`).textContent = quantities[productId];
        }

        function updateBilling() {
          const billingItems = document.getElementById('billing-items');
          billingItems.innerHTML = '';
          totalBelanja = 0;

          for (const productId in quantities) {
            if (quantities[productId] > 0) {
              const product = <?php echo json_encode($products); ?>.find(p => p.id_produk == productId);
              const itemTotal = product.harga_produk * quantities[productId];
              totalBelanja += itemTotal;

              const row = document.createElement('tr');
              row.innerHTML = `
                <td>${product.nama_produk}</td>
                <td>${quantities[productId]}</td>
                <td>Rp. ${itemTotal}</td>
              `;
              billingItems.appendChild(row);
            }
          }

          document.getElementById('total-belanja').textContent = `Total: Rp. ${totalBelanja}`;
        }

        function saveQuantitiesToLocalStorage() {
          localStorage.setItem('productQuantities', JSON.stringify(quantities));
        }

        function loadQuantitiesFromLocalStorage() {
          const storedQuantities = localStorage.getItem('productQuantities');
          if (storedQuantities) {
            Object.assign(quantities, JSON.parse(storedQuantities));
            for (const productId in quantities) {
              updateQuantityDisplay(productId);
            }
            updateBilling();
          }
        }

        loadQuantitiesFromLocalStorage();

        document.getElementById('btnPesan').addEventListener('click', function() {
            const namaPemesan = document.getElementById('namaPemesan').value;
            const catatan = document.getElementById('catatan').value;

            if (namaPemesan.trim() === '') {
                alert('Nama pemesan tidak boleh kosong');
                return;
            }

            const formData = new FormData();
            formData.append('nama_pemesan', namaPemesan);
            formData.append('catatan', catatan);
            formData.append('total_belanja', totalBelanja);

            for (const productId in quantities) {
                if (quantities[productId] > 0) {
                    formData.append('orderDetails[]', JSON.stringify({
                        id_produk: productId,
                        jumlah: quantities[productId]
                    }));
                }
            }

            $.ajax({
                url: '/kantinku/checkout',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        alert('Pesanan berhasil ditambahkan!');
                        localStorage.removeItem('productQuantities');
                        window.location.reload();
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat mengirim pesanan:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });

        });

      });
    </script>
  </body>
</html>

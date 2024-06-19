<?php

class ProductModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getProducts() {
        $query = "SELECT p.*, k.nama_kategori FROM tbl_produk p JOIN tbl_kategori k ON p.id_kategori = k.id_kategori ";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopProduk() {
        $query = "SELECT p.nama_produk, COUNT(dp.id_produk) AS jumlah
            FROM tbl_detail_penjualan dp
            JOIN tbl_produk p ON dp.id_produk = p.id_produk
            GROUP BY p.nama_produk
            ORDER BY jumlah DESC
            LIMIT 10";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahProduk($namaProduk, $hargaProduk, $stokProduk, $fotoProduk, $keteranganProduk, $idKategori) {
        $query = "INSERT INTO tbl_produk (nama_produk, harga_produk, stok_produk, foto_produk, keterangan_produk, id_kategori) 
                VALUES ('$namaProduk', $hargaProduk, $stokProduk, '$fotoProduk', '$keteranganProduk', $idKategori)";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ubahProduk($namaProduk, $hargaProduk, $stokProduk, $fotoProduk, $keteranganProduk, $idKategori, $idProduk) {
        $query = "UPDATE tbl_produk SET nama_produk = '$namaProduk', harga_produk = $hargaProduk, stok_produk = $stokProduk, foto_produk = '$fotoProduk', keterangan_produk = '$keteranganProduk', id_kategori = $idKategori WHERE id_produk = $idProduk";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isProdukUsedInDetailPenjualan($idProduk)
    {
        $query = "SELECT COUNT(*) as count FROM tbl_detail_penjualan WHERE id_produk = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idProduk);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] > 0;
    }

    public function hapusProduk($idProduk) {
        if ($this->isProdukUsedInDetailPenjualan($idProduk)) {
            return [
                'success' => false,
                'message' => 'Tidak dapat menghapus produk, karena terdapat di riwayat penjualan!'
            ];
        }

        $query = "DELETE FROM tbl_produk WHERE id_produk = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idProduk);
        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Produk berhasil dihapus.'
        ];
    }
}

?>

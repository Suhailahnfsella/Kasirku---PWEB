<?php
class DetailPenjualanModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getDetailPenjualan($idPenjualan) {
        $query = "SELECT * FROM tbl_penjualan WHERE id_penjualan = $idPenjualan";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createDetailPenjualan($idPenjualan, $idProduk, $jumlahProduk)
    {
        $insertStmt = $this->db->prepare("INSERT INTO tbl_detail_penjualan (jumlah, id_produk, id_penjualan) VALUES (?, ?, ?)");
        $insertStmt->bind_param("iii", $jumlahProduk, $idProduk, $idPenjualan);
        $insertStmt->execute();

        $updateStmt = $this->db->prepare("UPDATE tbl_produk SET stok_produk = stok_produk - ? WHERE id_produk = ?");
        $updateStmt->bind_param("ii", $jumlahProduk, $idProduk);
        $updateStmt->execute();
    }

}
?>

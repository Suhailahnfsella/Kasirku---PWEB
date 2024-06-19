<?php
class PenjualanModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getPenjualan() {
        $query = "SELECT * FROM tbl_penjualan WHERE DATE(tanggal_penjualan) = CURDATE() ORDER BY id_status ASC";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDetailPenjualan() {
        $query = "SELECT p.*, d.*, pr.* FROM tbl_penjualan p 
        JOIN tbl_detail_penjualan d ON p.id_penjualan = d.id_penjualan
        JOIN tbl_produk pr ON pr.id_produk = d.id_produk";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createPenjualan($tanggalPenjualan, $namaPembeli, $total, $catatan)
    {
        $stmt = $this->db->prepare("INSERT INTO tbl_penjualan (tanggal_penjualan, nama_pembeli, total, catatan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $tanggalPenjualan, $namaPembeli, $total, $catatan);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getIdPegawaiByUsername($usernamePegawai)
    {
        $query = "SELECT id_pegawai FROM tbl_pegawai WHERE username_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $usernamePegawai);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['id_pegawai'] ?? null;
    }
    
    public function editPenjualan($idPenjualan, $idStatus, $usernamePegawai)
    {
        $idPegawai = $this->getIdPegawaiByUsername($usernamePegawai);
        
        if ($idPegawai === null) {
            return false;
        }

        $query = "UPDATE tbl_penjualan SET id_status = ?, id_pegawai = ? WHERE id_penjualan = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $idStatus, $idPegawai, $idPenjualan);
        return $stmt->execute();
    }

    public function getOmset() {
        $query = "SELECT tanggal_penjualan, SUM(total) as total_penjualan
        FROM tbl_penjualan
        GROUP BY tanggal_penjualan
        ORDER BY tanggal_penjualan DESC";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

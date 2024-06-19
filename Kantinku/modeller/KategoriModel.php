<?php

class KategoriModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllKategori() {
        $query = "SELECT * FROM tbl_kategori";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isKategoriExist($namaKategori) {
        $query = "SELECT COUNT(*) as count FROM tbl_kategori WHERE nama_kategori = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $namaKategori);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function tambahKategori($namaKategori) {
        $query = "INSERT INTO tbl_kategori (nama_kategori) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $namaKategori);
        return $stmt->execute();
    }
}

?>

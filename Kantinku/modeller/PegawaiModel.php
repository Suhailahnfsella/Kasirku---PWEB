<?php

class PegawaiModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function index()
    {
        include_once __DIR__ . '/../views/dashboard_pegawai.php';
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM tbl_pegawai WHERE username_pegawai = ? AND status_pegawai = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllPegawai() {
        $query = "SELECT * FROM tbl_pegawai";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isUsernameExist($usernamePegawai) {
        $query = "SELECT COUNT(*) as count FROM tbl_pegawai WHERE username_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $usernamePegawai);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function isUsernameExist2($usernameLogin, $usernamePegawai) {
        $query = "SELECT COUNT(*) as count FROM tbl_pegawai WHERE username_pegawai = ? AND username_pegawai != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $usernamePegawai, $usernameLogin);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function updatePegawai($usernameLogin, $usernamePegawai, $passwordPegawai) {
        $query = "UPDATE tbl_pegawai SET username_pegawai = ?, password_pegawai = ? WHERE username_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $usernamePegawai, $passwordPegawai, $usernameLogin);
        return $stmt->execute();
    }

    public function tambahPegawai($namaPegawai, $usernamePegawai, $passwordPegawai) {
        $query = "INSERT INTO tbl_pegawai (nama_pegawai, username_pegawai, password_pegawai) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $namaPegawai, $usernamePegawai, $passwordPegawai);
        return $stmt->execute();
    }

    public function isPegawaiUsedInPenjualan($idPegawai)
    {
        $query = "SELECT COUNT(*) as count FROM tbl_penjualan WHERE id_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idPegawai);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] > 0;
    }

    public function hapusPegawai($idPegawai) {
        if ($this->isPegawaiUsedInPenjualan($idPegawai)) {
            return [
                'success' => false,
                'message' => 'Tidak dapat menghapus pegawai, karena pegawai telah menjadi foreign key di tabel penjualan.'
            ];
        }

        $query = "DELETE FROM tbl_pegawai WHERE id_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idPegawai);
        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Pegawai berhasil dihapus.'
        ];
    }

    public function editPegawai($idPegawai, $idStatus) {
        $query = "UPDATE tbl_pegawai SET status_pegawai = $idStatus WHERE id_pegawai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $idPegawai);
        return $stmt->execute();
    }
}

?>

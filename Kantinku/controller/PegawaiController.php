<?php

require_once 'modeller/PenjualanModel.php';
require_once 'modeller/DetailPenjualanModel.php';
require_once 'modeller/PegawaiModel.php';

class PegawaiController
{
    private function checkPegawai()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'pegawai') {
            header('Location: /kantinku/login_pegawai');
            exit();
        }
    }

    public function index()
    {
        $this->checkPegawai();

        $database = include_once __DIR__ . '/../database/db_connection.php';

        $penjualanModel = new PenjualanModel($database);
        $data_penjualan = $penjualanModel->getPenjualan();
        $detail_penjualan = $penjualanModel->getDetailPenjualan();

        require_once __DIR__ . '/../views/dashboard_pegawai.php';
    }

    public function editPenjualan()
    {
        $this->checkPegawai();

        $database = include_once __DIR__ . '/../database/db_connection.php';

        $username_pegawai = $_POST['username_pegawai'];
        $id_penjualan = $_POST['id_penjualan'];
        $id_status = $_POST['id_status'];

        $penjualanModel = new PenjualanModel($database);
        
        $result = $penjualanModel->editPenjualan($id_penjualan, $id_status, $username_pegawai);
    }

    public function profilPegawai(){
        $this->checkPegawai();

        $database = include_once __DIR__ . '/../database/db_connection.php';

        $username_pegawai = $_SESSION['username_pegawai'];

        $pegawaiModel = new PegawaiModel($database);
        
        $result = $pegawaiModel->getUserByUsername($username_pegawai);

        $nama_pegawai = $result['nama_pegawai'];
        $password_pegawai = $result['password_pegawai'];

        require_once __DIR__ . '/../views/profil_pegawai.php';
    }

    public function editProfil()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $username_login = $_SESSION['username_pegawai'];
        $username_pegawai = $_POST['username_pegawai'];
        $password_pegawai = $_POST['password_pegawai'];

        $pegawaiModel = new PegawaiModel($database);
        
        if ($pegawaiModel->isUsernameExist2($username_login, $username_pegawai)) {
            $response = [
                'success' => false,
                'message' => 'Username sudah digunakan!'
            ];
        } else {
            $result = $pegawaiModel->updatePegawai($username_login, $username_pegawai, $password_pegawai);
            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Profil berhasil diubah!'
                ];
            $_SESSION['username_pegawai'] = $username_pegawai;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal mengubah profil!'
                ];
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        session_destroy();

        header("Location: /kantinku/");
        exit;
    }
}
?>

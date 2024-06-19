<?php
session_start();

require_once 'modeller/AdminModel.php';
require_once 'modeller/PegawaiModel.php';

class IndexController
{
    public function index()
    {
        require_once __DIR__ . '/../views/index.php';
    }

    public function loginAdmin()
    {
        require_once __DIR__ . '/../views/login_admin.php';
    }

    public function getLoginAdmin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $adminModel = new AdminModel();
        $user = $adminModel->getUserByUsername($username);

        $hashedPassword = hash('sha256', $password);

        if ($user && $hashedPassword === $user['password_admin']) {
            $_SESSION['user_role'] = 'admin';
            $_SESSION['username_admin'] = $username;
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'message' => 'Username atau password salah'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function loginPegawai()
    {
        require_once __DIR__ . '/../views/login_pegawai.php';
    }

    public function getLoginPegawai()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $pegawaiModel = new PegawaiModel($database);
        $user = $pegawaiModel->getUserByUsername($username);

        $hashedPassword = hash('sha256', $password);

        if ($user && $hashedPassword === $user['password_pegawai']) {
            $_SESSION['user_role'] = 'pegawai';
            $_SESSION['username_pegawai'] = $username;
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'message' => 'Username atau password salah'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>
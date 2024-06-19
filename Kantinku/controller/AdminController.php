<?php

require_once 'modeller/ProductModel.php';
require_once 'modeller/KategoriModel.php';
require_once 'modeller/PegawaiModel.php';
require_once 'modeller/AdminModel.php';
require_once 'modeller/PenjualanModel.php';

class AdminController
{
    private function checkAdmin()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /kantinku/login_admin');
            exit();
        }
    }

    public function index()
    {
        $this->checkAdmin();
        include_once __DIR__ . '/../views/dashboard_admin.php';
    }

    public function produkAdmin()
    {
        $this->checkAdmin();
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $productModel = new ProductModel($database);
        $products = $productModel->getProducts(); 
        
        require_once __DIR__ . '/../views/produk_admin.php';
    }

    public function getAllKategori()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $kategoriModel = new KategoriModel($database);
        $kategories = $kategoriModel->getAllKategori(); 

        header('Content-Type: application/json');
        echo json_encode($kategories);
    }

    public function tambahKategori()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $nama_kategori = $_POST['nama_kategori'];
        $kategoriModel = new KategoriModel($database);
        
        if ($kategoriModel->isKategoriExist($nama_kategori)) {
            $response = [
                'success' => false,
                'message' => 'Kategori sudah ada'
            ];
        } else {
            $result = $kategoriModel->tambahKategori($nama_kategori);
            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Kategori berhasil ditambahkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal menambahkan kategori'
                ];
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function tambahProduk()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $uploadDir = 'views/assets/produk_img/';

        if (isset($_FILES['foto_produk'])) {
            $originalName = $_FILES['foto_produk']['name'];
            $tmpName = $_FILES['foto_produk']['tmp_name'];

            $randomName = uniqid() . '_' . mt_rand(1000, 9999) . '_' . $originalName;

            $destination = $uploadDir . $randomName;

            if (move_uploaded_file($tmpName, $destination)) {
                $foto_produk = $randomName;
                $nama_produk = $_POST['nama_produk'];
                $harga_produk = $_POST['harga_produk'];
                $stok_produk = $_POST['stok_produk'];
                $keterangan_produk = $_POST['keterangan_produk'];
                $id_kategori = $_POST['id_kategori'];
                
                $productModel = new ProductModel($database);

                $result = $productModel->tambahProduk($nama_produk, $harga_produk, $stok_produk, $foto_produk, $keterangan_produk, $id_kategori);
            } 
            
        }
    }

    public function updateProduk()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $uploadDir = 'views/assets/produk_img/';

        $productModel = new ProductModel($database);

        $id_produk = $_POST['id_produk'];
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $stok_produk = $_POST['stok_produk'];
        $keterangan_produk = $_POST['keterangan_produk'];
        $id_kategori = $_POST['id_kategori'];

        if (isset($_FILES['ada_foto_produk']) && $_FILES['ada_foto_produk']['error'] == UPLOAD_ERR_OK) {
            $originalName = $_FILES['ada_foto_produk']['name'];
            $tmpName = $_FILES['ada_foto_produk']['tmp_name'];
    
            $randomName = uniqid() . '_' . mt_rand(1000, 9999) . '_' . $originalName;
            $destination = $uploadDir . $randomName;
    
            if (move_uploaded_file($tmpName, $destination)) {
                $result = $productModel->ubahProduk($nama_produk, $harga_produk, $stok_produk, $randomName, $keterangan_produk, $id_kategori, $id_produk);
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            $fotoproduk = $_POST['foto_produk'];
            $result = $productModel->ubahProduk($nama_produk, $harga_produk, $stok_produk, $fotoproduk, $keterangan_produk, $id_kategori, $id_produk);
        }
    }

    public function hapusProduk()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $id_produk = $_POST['id_produk'];

        $productModel = new ProductModel($database);
        
        $result = $productModel->hapusProduk($id_produk);
        
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function pegawaiAdmin()
    {
        $this->checkAdmin();
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $pegawaiModel = new PegawaiModel($database);
        $pegawaies = $pegawaiModel->getAllPegawai(); 

        require_once __DIR__ . '/../views/pegawai_admin.php';
    }

    public function tambahPegawai()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $nama_pegawai = $_POST['nama_pegawai'];
        $username_pegawai = $_POST['username_pegawai'];
        $password_pegawai = $_POST['password_pegawai'];

        $pegawaiModel = new PegawaiModel($database);
        
        if ($pegawaiModel->isUsernameExist($username_pegawai)) {
            $response = [
                'success' => false,
                'message' => 'Username sudah digunakan!'
            ];
        } else {
            $result = $pegawaiModel->tambahPegawai($nama_pegawai, $username_pegawai, $password_pegawai);
            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Pegawai berhasil ditambahkan!'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal menambahkan pegawai!'
                ];
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function hapusPegawai()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $id_pegawai = $_POST['id_pegawai'];

        $pegawaiModel = new PegawaiModel($database);
        
        $result = $pegawaiModel->hapusPegawai($id_pegawai);
        
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function editPegawai()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $id_pegawai = $_POST['id_pegawai'];
        $id_status = $_POST['id_status'];

        $pegawaiModel = new PegawaiModel($database);
        
        $result = $pegawaiModel->editPegawai($id_pegawai, $id_status);
    }

    public function profilAdmin()
    {
        $this->checkAdmin();
        $username_admin = $_SESSION['username_admin'];

        $adminModel = new AdminModel();
        
        $result = $adminModel->getUserByUsername($username_admin);

        $nama_admin = $result['nama_admin'];
        $email_admin = $result['email_admin'];
        $password_admin = $result['password_admin'];

        require_once __DIR__ . '/../views/profil_admin.php';
    }

    public function editProfil()
    {
        $username_login = $_SESSION['username_admin'];
        $username_admin = $_POST['username_admin'];
        $email_admin = $_POST['email_admin'];
        $password_admin = $_POST['password_admin'];

        $adminModel = new AdminModel();
        
        if ($adminModel->isUsernameExist($username_login, $username_admin)) {
            $response = [
                'success' => false,
                'message' => 'Username sudah digunakan!'
            ];
        } else if ($adminModel->isEmailExist($username_login, $email_admin)) {
            $response = [
                'success' => false,
                'message' => 'Email sudah digunakan!'
            ];
        } else {
            $result = $adminModel->updateAdmin($username_login, $username_admin, $email_admin, $password_admin);
            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Profil berhasil diubah!'
                ];
            $_SESSION['username_admin'] = $username_admin;
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

    public function topProduk(){
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $productModel = new ProductModel($database);
        $data = $productModel->getTopProduk(); 

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getOmset(){
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $penjualanModel = new PenjualanModel($database);
        $data = $penjualanModel->getOmset(); 

        header('Content-Type: application/json');
        echo json_encode($data);
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
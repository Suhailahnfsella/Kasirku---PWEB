<?php

require_once 'modeller/ProductModel.php';
require_once 'modeller/PenjualanModel.php';
require_once 'modeller/DetailPenjualanModel.php';

class PelangganController
{
    public function dashboardPelanggan()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';

        $penjualanModel = new PenjualanModel($database);
        $data_penjualan = $penjualanModel->getPenjualan();
        $detail_penjualan = $penjualanModel->getDetailPenjualan();

        require_once __DIR__ . '/../views/dashboard_pelanggan.php';
    }

    public function pesan()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $productModel = new ProductModel($database);
        $products = $productModel->getProducts(); 
        
        require_once __DIR__ . '/../views/pesan_pelanggan.php';
    }

    public function checkout()
    {
        $database = include_once __DIR__ . '/../database/db_connection.php';
        $penjualanModel = new PenjualanModel($database);
        $detailPenjualanModel = new DetailPenjualanModel($database);
        
        $namaPemesan = $_POST['nama_pemesan'];
        $catatan = $_POST['catatan'];
        $totalBelanja = $_POST['total_belanja'];
        $orderDetails = $_POST['orderDetails'];

        $tanggalPenjualan = date("Y-m-d");

        $idPenjualan = $penjualanModel->createPenjualan($tanggalPenjualan, $namaPemesan, $totalBelanja, $catatan);

        foreach ($orderDetails as $detail) {
            $detail = json_decode($detail, true);
            $idProduk = $detail['id_produk'];
            $jumlahProduk = $detail['jumlah'];
            $detailPenjualanModel->createDetailPenjualan($idPenjualan, $idProduk, $jumlahProduk);
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
}
?>

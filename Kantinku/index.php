<?php

require_once 'controller/IndexController.php';
require_once 'controller/AdminController.php';
require_once 'controller/PegawaiController.php';
require_once 'controller/PelangganController.php';
require_once 'router/index.php';

$indexController = new IndexController();
$adminController = new AdminController();
$pegawaiController = new PegawaiController();
$pelangganController = new PelangganController();

$router = new FileRouter();

$router->addRoute('GET', '/kantinku/', [$indexController, 'index']);
$router->addRoute('GET', '/kantinku/home', [$indexController, 'index']);

$router->addRoute('GET', '/kantinku/login_admin', [$indexController, 'loginAdmin']);
$router->addRoute('POST', '/kantinku/setLoginAdmin', [$indexController, 'getLoginAdmin']);

$router->addRoute('GET', '/kantinku/login_pegawai', [$indexController, 'loginPegawai']);
$router->addRoute('POST', '/kantinku/setLoginPegawai', [$indexController, 'getLoginPegawai']);

$router->addRoute('GET', '/kantinku/dashboard_admin', [$adminController, 'index']);

$router->addRoute('GET', '/kantinku/kelola_produk', [$adminController, 'produkAdmin']);
$router->addRoute('GET', '/kantinku/get_kategori', [$adminController, 'getAllKategori']);
$router->addRoute('POST', '/kantinku/tambah_produk', [$adminController, 'tambahProduk']);
$router->addRoute('POST', '/kantinku/update_produk', [$adminController, 'updateProduk']);
$router->addRoute('POST', '/kantinku/tambah_kategori', [$adminController, 'tambahKategori']);
$router->addRoute('POST', '/kantinku/hapus_produk', [$adminController, 'hapusProduk']);

$router->addRoute('GET', '/kantinku/top_produk', [$adminController, 'topProduk']);
$router->addRoute('GET', '/kantinku/omset_penjualan', [$adminController, 'getOmset']);

$router->addRoute('GET', '/kantinku/kelola_pegawai', [$adminController, 'pegawaiAdmin']);
$router->addRoute('POST', '/kantinku/tambah_pegawai', [$adminController, 'tambahPegawai']);
$router->addRoute('POST', '/kantinku/hapus_pegawai', [$adminController, 'hapusPegawai']);
$router->addRoute('POST', '/kantinku/edit_pegawai', [$adminController, 'editPegawai']);

$router->addRoute('GET', '/kantinku/profil_admin', [$adminController, 'profilAdmin']);
$router->addRoute('POST', '/kantinku/edit_admin', [$adminController, 'editProfil']);
$router->addRoute('GET', '/kantinku/logoutadmin', [$adminController, 'logout']);

$router->addRoute('GET', '/kantinku/dashboard_pegawai', [$pegawaiController, 'index']);
$router->addRoute('GET', '/kantinku/profil_pegawai', [$pegawaiController, 'profilPegawai']);
$router->addRoute('POST', '/kantinku/ubah_pegawai', [$pegawaiController, 'editProfil']);
$router->addRoute('GET', '/kantinku/logoutpegawai', [$pegawaiController, 'logout']);

$router->addRoute('POST', '/kantinku/edit_penjualan', [$pegawaiController, 'editPenjualan']);

$router->addRoute('GET', '/kantinku/dashboard_pelanggan', [$pelangganController, 'dashboardPelanggan']);
$router->addRoute('GET', '/kantinku/pesan', [$pelangganController, 'pesan']);
$router->addRoute('POST', '/kantinku/checkout', [$pelangganController, 'checkout']);
$router->addRoute('GET', '/kantinku/keluarpelanggan', [$indexController, 'index']);

$router->dispatch();
?>

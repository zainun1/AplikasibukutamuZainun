<?php
// =======================================================
// File: index.php (root)
// Deskripsi: Routing utama aplikasi Buku Tamu
// =======================================================

// Load config, koneksi, path
require_once __DIR__ . '/includes/path.php';
require_once INCLUDES_PATH . 'konfig.php';
require_once INCLUDES_PATH . 'koneksi.php';

session_start();

// Ambil parameter halaman
$halaman = isset($_GET['hal']) ? trim($_GET['hal']) : 'home';

// Mencegah akses direktori
$halaman = basename(str_replace('.php', '', $halaman));


// =======================================================
//                    ROUTING LANDING
// =======================================================
switch ($halaman) {

    // ----------------------- Landing Page -----------------------
    case '':
    case 'home':
        $file_view = VIEWS_PATH . 'landing/home.php';
        break;

    case 'tentang':
        $file_view = VIEWS_PATH . 'landing/tentang.php';
        break;

    case 'kontak':
        $file_view = VIEWS_PATH . 'landing/kontak.php';
        break;


    // =======================================================
    //              OTENTIKASI TAMU
    // =======================================================
    case 'logintamu':
        $file_view = VIEWS_PATH . 'otentikasitamu/logintamu.php';
        break;

    case 'registertamu':
        $file_view = VIEWS_PATH . 'otentikasitamu/registertamu.php';
        break;

    case 'prosesregistertamu':
        $file_view = VIEWS_PATH . 'otentikasitamu/prosesregistertamu.php';
        break;

    case 'proseslogintamu':
        $file_view = VIEWS_PATH . 'otentikasitamu/proseslogintamu.php';
        break;

    case 'logouttamu':
        $file_view = VIEWS_PATH . 'otentikasitamu/logouttamu.php';
        break;


    // =======================================================
    //                  DASHBOARD TAMU
    // =======================================================
    case 'dashboardtamu':
        $file_view = VIEWS_PATH . 'tamu/dashboardtamu.php';
        break;


    // =======================================================
    //                 CRUD DATA TAMU
    // =======================================================
    case 'daftartamu':
        $file_view = VIEWS_PATH . 'tamu/daftartamu.php';
        break;

    case 'tambahtamu':
        $file_view = VIEWS_PATH . 'tamu/tambahtamu.php';
        break;

    case 'prosestambahtamu':
        $file_view = VIEWS_PATH . 'tamu/prosestambahtamu.php';
        break;

    case 'edittamu':
        $file_view = VIEWS_PATH . 'tamu/edittamu.php';
        break;

    case 'prosesedittamu':
        $file_view = VIEWS_PATH . 'tamu/prosesedittamu.php';
        break;

    case 'hapustamu':
        $file_view = VIEWS_PATH . 'tamu/hapustamu.php';
        break;


    // =======================================================
    //               KOMENTAR PUBLIK
    // =======================================================
    case 'proseskomentar':
        $file_view = VIEWS_PATH . 'landing/proseskomentar.php';
        break;


    // =======================================================
    //                 404 Not Found
    // =======================================================
    default:
        $file_view = VIEWS_PATH . 'landing/404.php';
        break;
}


// =======================================================
//            TEMPLATE LANDING (HEADER - NAVBAR)
// =======================================================
include PAGES_PATH . 'landing/header.php';
include PAGES_PATH . 'landing/navbar.php';

// Hero hanya tampil di home
if ($halaman === 'home') {
    include PAGES_PATH . 'landing/hero.php';
}

// Konten Utama
if (file_exists($file_view)) {
    include $file_view;
} else {
    include VIEWS_PATH . 'landing/404.php';
}

// Footer
include PAGES_PATH . 'landing/footer.php';

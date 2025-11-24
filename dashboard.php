<?php
// =======================================================
// File: dashboard.php - Routing Backend BUKU TAMU (FINAL)
// =======================================================

require_once __DIR__ . '/includes/path.php';
require_once INCLUDES_PATH . 'konfig.php';
require_once INCLUDES_PATH . 'koneksi.php';

session_start();

// =======================================================
// 1️⃣ Ambil role & tentukan folder view
// =======================================================
$role = $_SESSION['role'] ?? '';

switch ($role) {

    case 'petugas':
        $viewFolder  = 'views/user';
        $defaultPage = 'dashboardpetugas';
        break;

    case 'tamu':
        $viewFolder  = 'views/tamu';
        $defaultPage = 'dashboardtamu';
        break;

    default: // admin
        $viewFolder  = 'views/user';
        $defaultPage = 'dashboardadmin';
        break;
}


// =======================================================
// 2️⃣ Ambil parameter halaman
// =======================================================
$hal = $_GET['hal'] ?? $defaultPage;
$halPath = explode('/', $hal);


// =======================================================
// 3️⃣ Role Protection Khusus Petugas
//    (petugas tidak boleh mengelola user, kategori sistem, dll)
// =======================================================
$petugasDilarang = [
    'user',
    'laporan',
];

if ($role === 'petugas') {
    $requested = $halPath[0] ?? '';
    if (in_array($requested, $petugasDilarang)) {
        header("Location: dashboard.php?hal=notfound");
        exit;
    }
}


// =======================================================
// 4️⃣ Tentukan file target berdasarkan struktur folder
// =======================================================
if (count($halPath) > 1) {

    $module = $halPath[0];
    $page   = $halPath[1];

    $fileCandidate = BASE_PATH . "/{$viewFolder}/{$module}/{$page}.php";

    if (file_exists($fileCandidate)) {
        $file = $fileCandidate;

    } else {

        // fallback default per modul Buku Tamu
        $fallbacks = [
            'tamu'      => 'tamu/daftartamu',
            'asal'      => 'asal/daftarasal',
            'kategori'  => 'kategori/daftarkategori',
            'komentar'  => 'komentar/daftarkomentar',
            'laporan'   => 'laporan/daftarlaporan'
        ];

        if (isset($fallbacks[$module])) {
            $file = BASE_PATH . "/{$viewFolder}/" . $fallbacks[$module] . ".php";
        } else {
            $file = BASE_PATH . "/views/notfound.php";
        }
    }

} else {
    // Jika hanya hal=dashboardadmin
    $simpleFile = BASE_PATH . "/{$viewFolder}/{$hal}.php";

    $file = file_exists($simpleFile)
        ? $simpleFile
        : BASE_PATH . "/views/notfound.php";
}


// =======================================================
// 5️⃣ Jika user belum login → redirect ke login tamu/admin
// =======================================================
if (!isset($_SESSION['role'])) {
    header("Location: " . BASE_URL . "?hal=logintamu");
    exit;
}


// =======================================================
// 6️⃣ Load View
// =======================================================
include $file;

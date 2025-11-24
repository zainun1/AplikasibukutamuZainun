<?php
// =======================================================
// File: includes/konfig.php
// Deskripsi: Variabel global & pengaturan aplikasi Peminjaman Alat RPL
// =======================================================

// Base URL (hanya dibuat jika belum didefinisikan di path.php)
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/ZainunAplikasibukutamuZainun/');
}

$base_url     = BASE_URL;
$site_name    = "AplikasibukutamuZainun";
$site_desc    = "AplikasibukutamuZainun";
$site_version = "1.0.0";
$penulis      = "zainun";

// Timezone Indonesia
date_default_timezone_set('Asia/Jakarta');

// =======================================================
// Fungsi Helper (mengikuti CMSMAHDI)
// =======================================================

// Generate URL dengan path tambahan
function url($path = '') {
    return BASE_URL . ltrim($path, '/');
}
?>

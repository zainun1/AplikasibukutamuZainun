<?php
// =======================================
// File: views/otentikasitamu/logouttamu.php
// Deskripsi: Logout tamu & redirect ke halaman login tamu
// =======================================

// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load konfigurasi & path
require_once __DIR__ . '/../../includes/path.php';
require_once __DIR__ . '/../../includes/koneksi.php';

// Hapus semua session
$_SESSION = [];
session_destroy();

// Redirect ke halaman login tamu
header("Location: " . BASE_URL . "?hal=logintamu");
exit;

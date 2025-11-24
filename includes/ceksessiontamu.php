<?php
// =====================================================================
// File   : includes/ceksessiontamu.php
// Fungsi : Mengecek apakah tamu sudah login
// Lokasi : /includes/
// =====================================================================

// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah tamu sudah login
if (
    !isset($_SESSION['login']) || 
    $_SESSION['login'] !== true || 
    ($_SESSION['role'] ?? '') !== 'tamu'
) {
    // Jika belum login atau bukan role tamu → redirect ke login tamu
    header("Location: " . BASE_URL . "?hal=logintamu");
    exit;
}

// Optional: Set variabel global untuk dipakai di halaman lain
$idtamu   = $_SESSION['idtamu']   ?? null;
$namatamu = $_SESSION['namatamu'] ?? null;
$username = $_SESSION['username'] ?? null;
$foto     = $_SESSION['foto']     ?? null;
$role     = $_SESSION['role']     ?? null;

<?php
// ==============================================
// File: views/otentikasitamu/proseslogintamu.php
// Deskripsi: Proses backend login tamu
// Versi final siap pakai
// ==============================================

$ROOT = realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR;
require_once $ROOT . 'includes/konfig.php';
require_once $ROOT . 'includes/koneksi.php';
require_once $ROOT . 'includes/fungsivalidasi.php';

// =======================================
// Mulai session jika belum aktif
// =======================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =======================================
// Ambil & bersihkan input
// =======================================
$username = bersihkan($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// =======================================
// Validasi input kosong
// =======================================
if (empty($username) || empty($password)) {
    header("Location: " . BASE_URL . "?hal=logintamu&pesan=" . urlencode("Isi semua kolom"));
    exit;
}

// =======================================
// Query tamu berdasarkan username
// =======================================
$stmt = $koneksi->prepare("SELECT * FROM tamu WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// =======================================
// Cek hasil query
// =======================================
if ($result->num_rows === 1) {
    $tamu = $result->fetch_assoc();

    // =======================================
    // Verifikasi password hash
    // =======================================
    if (password_verify($password, $tamu['password'])) {

        // =======================================
        // Set session tamu
        // =======================================
        $_SESSION['login']      = true;
        $_SESSION['idtamu']     = $tamu['idtamu'];
        $_SESSION['namatamu']   = $tamu['namatamu'];
        $_SESSION['username']   = $tamu['username'];
        $_SESSION['foto']       = $tamu['foto'] ?? '';
        $_SESSION['role']       = 'tamu';

        // =======================================
        // Redirect ke dashboard tamu
        // =======================================
        header("Location: " . BASE_URL . "dashboard.php?hal=dashboardtamu");
        exit;
    }
}

// =======================================
// Jika login gagal
// =======================================
header("Location: " . BASE_URL . "?hal=logintamu&pesan=" . urlencode("Username atau password salah"));
exit;

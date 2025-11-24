<?php
// ============================================================
// File: views/otentikasitamu/prosesregistertamu.php
// Proses registrasi tamu baru
// ============================================================

require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "?hal=registertamu");
    exit;
}

// Ambil input
$namatamu  = trim($_POST['namatamu']);
$username  = trim($_POST['username']);
$password  = $_POST['password'];
$idasal    = $_POST['idasal'] ?: null; // jika ada relasi asal (opsional)

// =======================================
// Validasi username unik
// =======================================
$stmt = $koneksi->prepare("SELECT idtamu FROM tamu WHERE username=? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: " . BASE_URL . "?hal=registertamu&error=Username sudah digunakan");
    exit;
}
$stmt->close();

// =======================================
// Hash password
// =======================================
$hashPassword = password_hash($password, PASSWORD_DEFAULT);

// =======================================
// Upload foto tamu (opsional)
// =======================================
$fotoFile = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoFile = 'tamu_' . time() . '.' . $ext;

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        __DIR__ . '/../../uploads/tamu/' . $fotoFile
    );
}

// =======================================
// Insert ke database
// =======================================
$stmt = $koneksi->prepare("
    INSERT INTO tamu (idasal, namatamu, username, password, foto) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("issss", $idasal, $namatamu, $username, $hashPassword, $fotoFile);
$success = $stmt->execute();
$stmt->close();

// =======================================
// Redirect setelah proses
// =======================================
if ($success) {
    header("Location: " . BASE_URL . "?hal=logintamu&success=Registrasi berhasil! Silakan login.");
} else {
    header("Location: " . BASE_URL . "?hal=registertamu&error=Terjadi kesalahan, coba lagi.");
}
exit;

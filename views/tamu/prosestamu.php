<?php
// ============================================================
// File: views/tamu/prosestamu.php
// Deskripsi: Proses tambah tamu (Buku Tamu)
// ============================================================

session_start();
require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'koneksi.php';

// Cek login admin/petugas
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'petugas')) {
    header("Location: ?hal=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $namatamu = $_POST['namatamu'] ?? '';
    $nohp     = $_POST['nohp'] ?? '';
    $jumlah   = $_POST['jumlah'] ?? 1;
    $asal     = $_POST['asal'] ?? '';
    $tujuan   = $_POST['tujuan'] ?? '';

    // Validasi
    if (empty($namatamu) || empty($nohp) || empty($asal) || empty($tujuan)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        header("Location: ?hal=tambahtamu");
        exit;
    }

    // Upload foto (opsional)
    $foto_filename = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_filename = 'tamu_' . time() . '.' . $ext;

        // folder uploads tamu
        $upload_path = __DIR__ . '/uploads/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path . $foto_filename);
    }

    try {
        $koneksi->beginTransaction();

        // INSERT ke tabel tamu
        $sql = "INSERT INTO tamu (namatamu, nohp, foto, jumlah, tujuan, asal)
                VALUES (:namatamu, :nohp, :foto, :jumlah, :tujuan, :asal)";

        $stmt = $koneksi->prepare($sql);
        $stmt->execute([
            ':namatamu' => $namatamu,
            ':nohp'     => $nohp,
            ':foto'     => $foto_filename,
            ':jumlah'   => $jumlah,
            ':tujuan'   => $tujuan,
            ':asal'     => $asal
        ]);

        $koneksi->commit();
        $_SESSION['success'] = "Tamu berhasil ditambahkan!";
        header("Location: ?hal=daftartamu");
        exit;

    } catch (Exception $e) {
        $koneksi->rollBack();
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
        header("Location: ?hal=tambahtamu");
        exit;
    }

} else {
    header("Location: ?hal=daftartamu");
    exit;
}

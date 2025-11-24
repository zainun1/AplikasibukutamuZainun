<?php
// ============================================================
// File: views/tamu/tambahtamu.php
// Deskripsi: Form tambah data tamu untuk Buku Tamu
// ============================================================

session_start();
require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'koneksi.php';

// Cek login admin/petugas
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'petugas')) {
    header("Location: ?hal=login");
    exit;
}
?>

<?php include PAGES_PATH . 'tamu/header.php'; ?>

<div class="container mt-4">
    <h2>Tambah Tamu</h2>

    <form action="?hal=proses_tambahtamu" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Nama Tamu</label>
            <input type="text" name="namatamu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="nohp" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Orang</label>
            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Asal</label>
            <input type="text" name="asal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan</label>
            <input type="text" name="tujuan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="?hal=daftartamu" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include PAGES_PATH . 'tamu/footer.php'; ?>

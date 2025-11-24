<?php
// ============================================================
// File: views/tamu/edittamu.php
// Deskripsi: Halaman edit data tamu
// ============================================================

session_start();
require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'koneksi.php';

// Cek login
if (!isset($_SESSION['idtamu'])) {
    header("Location: ?hal=logintamu");
    exit;
}

$idtamu = intval($_GET['id'] ?? 0);

// Ambil data tamu
$stmt = $koneksi->prepare("SELECT * FROM tamu WHERE idtamu = ? LIMIT 1");
$stmt->bind_param("i", $idtamu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>Data tamu tidak ditemukan.</div>";
    exit;
}

$tamu = $result->fetch_assoc();

// Ambil daftar asal
$asal = mysqli_query($koneksi, "SELECT * FROM asal ORDER BY namaasal ASC");
$asalList = mysqli_fetch_all($asal, MYSQLI_ASSOC);

?>

<div class="container mt-4">
    <h3>Edit Data Tamu</h3>
    <hr>

    <form action="?hal=prosesedittamu" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="idtamu" value="<?= $tamu['idtamu'] ?>">
        <input type="hidden" name="fotolama" value="<?= $tamu['foto'] ?>">

        <div class="mb-3">
            <label class="form-label">Nama Tamu</label>
            <input type="text" name="namatamu" class="form-control"
                   value="<?= htmlspecialchars($tamu['namatamu']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="nohp" class="form-control"
                   value="<?= htmlspecialchars($tamu['nohp']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Tamu</label>
            <input type="number" name="jumlah" class="form-control"
                   value="<?= htmlspecialchars($tamu['jumlah']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan</label>
            <input type="text" name="tujuan" class="form-control"
                   value="<?= htmlspecialchars($tamu['tujuan']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Asal</label>
            <select name="idasal" class="form-control">
                <option value="">-- Pilih Asal --</option>
                <?php foreach ($asalList as $a): ?>
                    <option value="<?= $a['idasal'] ?>"
                        <?= $a['idasal'] == $tamu['idasal'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['namaasal']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- FOTO -->
        <div class="mb-3">
            <label class="form-label">Foto Baru (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            
            <?php if ($tamu['foto']): ?>
                <p class="mt-2">Foto lama:</p>
                <img src="uploads/tamu/<?= $tamu['foto'] ?>" width="120" class="rounded border">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="?hal=daftartamu" class="btn btn-secondary">Batal</a>

    </form>
</div>

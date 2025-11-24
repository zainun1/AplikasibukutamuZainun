<?php
// ============================================================
// Dashboard TAMU – Buku Tamu Digital
// ============================================================

require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'konfig.php';
require_once INCLUDES_PATH . 'koneksi.php';

// ===============================
// Cek apakah tamu sudah login
// ===============================
if (!isset($_SESSION['idtamu'])) {
    header("Location: " . BASE_URL . "?hal=logintamu&pesan=Silakan login dulu");
    exit;
}

$idtamu = $_SESSION['idtamu'];

// ===============================
// Ambil data tamu dari database
// ===============================
$stmt = $koneksi->prepare("SELECT * FROM tamu WHERE idtamu = ? LIMIT 1");
$stmt->bind_param("i", $idtamu);
$stmt->execute();
$tamu = $stmt->get_result()->fetch_assoc();
$stmt->close();

// ===============================
// Layout (header + navbar khusus tamu)
// ===============================
include PAGES_PATH . 'tamu/header.php';
include PAGES_PATH . 'tamu/navbar.php';
?>

<div class="container mt-4">
    <h2>Selamat Datang, <?= htmlspecialchars($tamu['namatamu']) ?>!</h2>
    <p class="text-muted">Anda login sebagai tamu.</p>

    <div class="row mt-3">

        <!-- Card Biodata -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">Biodata Tamu</div>
                <div class="card-body">

                    <p><strong>Nama:</strong><br><?= htmlspecialchars($tamu['namatamu']) ?></p>

                    <p><strong>No HP:</strong><br><?= htmlspecialchars($tamu['nohp']) ?></p>

                    <p><strong>Asal Instansi:</strong><br><?= htmlspecialchars($tamu['asal']) ?></p>

                    <p><strong>Tujuan Kunjungan:</strong><br><?= htmlspecialchars($tamu['tujuan']) ?></p>

                    <p><strong>Jumlah Orang:</strong><br><?= htmlspecialchars($tamu['jumlah']) ?> orang</p>

                    <?php if (!empty($tamu['foto'])): ?>
                        <p><strong>Foto:</strong></p>
                        <img src="<?= BASE_URL . 'uploads/tamu/' . $tamu['foto'] ?>" 
                             class="img-thumbnail" style="max-width: 150px;">
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- Card Menu Tamu -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">Menu Tamu</div>
                <div class="card-body">

                    <a href="<?= BASE_URL ?>?hal=tamu/editprofil"
                       class="btn btn-warning mb-2 w-100 fw-bold">
                        ✏ Edit Profil Tamu
                    </a>

                    <a href="<?= BASE_URL ?>?hal=tamu/riwayat"
                       class="btn btn-info mb-2 w-100 fw-bold">
                        📄 Riwayat Kunjungan
                    </a>

                    <a href="<?= BASE_URL ?>?hal=logout"
                       class="btn btn-danger w-100 fw-bold">
                        🚪 Logout
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>

<?php include PAGES_PATH . 'tamu/footer.php'; ?>

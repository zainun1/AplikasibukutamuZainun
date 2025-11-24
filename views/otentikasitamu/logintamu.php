<?php
// ============================================================
// File: views/otentikasitamu/logintamu.php
// Login khusus untuk TAMU aplikasi buku tamu
// ============================================================

// Include path & konfigurasi
require_once __DIR__ . '/../../includes/path.php';
require_once INCLUDES_PATH . 'konfig.php';

// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika tamu sudah login → redirect ke dashboard tamu
if (isset($_SESSION['role']) && $_SESSION['role'] === 'tamu') {
    header("Location: " . BASE_URL . "?hal=dashboardtamu");
    exit();
}

// Pesan error
$error = $_GET['pesan'] ?? '';
?>

<style>
  .login-wrapper {
    min-height: calc(100vh - 100px);
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="login-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-lg border-0">

          <div class="card-header bg-primary text-center py-3">
            <h3 class="m-0 fw-bold text-white">Login Tamu</h3>
          </div>

          <div class="card-body p-4">

            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="?hal=proseslogintamu">

              <div class="mb-3">
                <label for="namatamu" class="form-label">Nama Tamu</label>
                <input type="text" name="namatamu" id="namatamu" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="nohp" class="form-label">Nomor HP</label>
                <input type="text" name="nohp" id="nohp" class="form-control" required>
              </div>

              <div class="d-flex justify-content-between mb-3">
                <a href="<?= BASE_URL ?>?hal=registertamu"
                   class="btn btn-warning px-4">
                  <b>Daftar Tamu Baru</b>
                </a>

                <button type="submit" class="btn btn-primary px-4">Login</button>
              </div>
            </form>

            <div class="text-center mt-1">
              <a href="<?= BASE_URL ?>">← Kembali ke Beranda</a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

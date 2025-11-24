<?php
require_once __DIR__ . '/../../../includes/path.php';
require_once INCLUDES_PATH . 'koneksi.php';
require_once INCLUDES_PATH . 'ceksession.php';

// Ambil ID kategori
$id = $_GET['id'] ?? 0;

// Ambil data kategori yang akan diedit
$stmt = $koneksi->prepare("SELECT * FROM kategori WHERE idkategori = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$kategori = $result->fetch_assoc();

if (!$kategori) {
    header("Location: " . BASE_URL . "dashboard.php?hal=kategori/daftarkategori&msg=notfound");
    exit;
}

// Ambil semua data untuk daftar
$data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY idkategori DESC");
?>

<?php include PAGES_PATH . 'user/header.php'; ?>
<?php include PAGES_PATH . 'user/navbar.php'; ?>
<?php include PAGES_PATH . 'user/sidebar.php'; ?>

<div class="content p-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- ========== FORM EDIT KATEGORI ========== -->
        <div class="col-md-4">
          <div class="card card-warning">
            <div class="card-header bg-gradient-warning">
              <h3 class="card-title">
                <i class="fas fa-edit"></i> Edit Kategori
              </h3>
            </div>

            <form action="<?= BASE_URL ?>views/user/kategori/proseskategori.php" method="POST">
              <input type="hidden" name="aksi" value="edit">
              <input type="hidden" name="idkategori" value="<?= $kategori['idkategori'] ?>">

              <div class="card-body">
                <div class="form-group">
                  <label>Nama Kategori</label>
                  <input type="text"
                         name="namakategori"
                         class="form-control"
                         value="<?= htmlspecialchars($kategori['namakategori']); ?>"
                         required>
                </div>
              </div>

              <div class="card-footer text-right">
                <a href="<?= BASE_URL ?>dashboard.php?hal=kategori/daftarkategori"
                   class="btn btn-secondary btn-sm">
                  <i class="fas fa-arrow-left"></i> Batal
                </a>

                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fas fa-save"></i> Update
                </button>
              </div>

            </form>
          </div>
        </div>

        <!-- ========== DAFTAR KATEGORI ========== -->
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="m-0">Daftar Kategori</h5>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="bg-light text-center">
                  <tr>
                    <th style="width:5%;">No</th>
                    <th>Nama Kategori</th>
                    <th style="width:15%;">Aksi</th>
                  </tr>
                </thead>

                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['namakategori']); ?></td>

                    <td class="text-center">
                      <a href="<?= BASE_URL ?>dashboard.php?hal=kategori/editkategori&id=<?= $row['idkategori'] ?>"
                         class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>

                      <a onclick="return confirm('Hapus kategori ini?')"
                         href="<?= BASE_URL ?>views/user/kategori/proseskategori.php?aksi=hapus&id=<?= $row['idkategori'] ?>"
                         class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php include PAGES_PATH . 'user/footer.php'; ?>

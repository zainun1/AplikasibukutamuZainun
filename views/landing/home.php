<?php
// Pastikan koneksi sudah ada
include "includes/koneksi.php";

// Query untuk menampilkan kunjungan terbaru
$query = "
    SELECT k.*, 
           t.namatamu, 
           t.nohp AS nohp_tamu,
           d.namadivisi,
           u.namauser AS petugas
    FROM kunjungan k
    LEFT JOIN tamu t ON k.idtamu = t.idtamu
    LEFT JOIN divisi d ON k.iddivisi = d.iddivisi
    LEFT JOIN user u ON k.iduser = u.iduser
    ORDER BY k.idkunjungan DESC
    LIMIT 5
";

$result = mysqli_query($koneksi, $query);
?>

<div class="container mt-4">
    <h3 class="text-center mb-4">Kunjungan Terbaru</h3>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['judulkunjungan']); ?></h5>
                        <p class="card-text">
                            <strong>Tamu:</strong> <?= htmlspecialchars($row['namatamu']); ?><br>
                            <strong>Divisi:</strong> <?= htmlspecialchars($row['namadivisi']); ?><br>
                            <strong>Tanggal:</strong> <?= htmlspecialchars($row['tanggal']); ?><br>
                            <strong>Status:</strong> 
                            <span class="badge 
                                <?= $row['status'] == 'pending' ? 'bg-warning' : ($row['status']=='setujui'?'bg-success':'bg-danger'); ?>">
                                <?= htmlspecialchars($row['status']); ?>
                            </span>
                        </p>
                        <a href="#" class="btn btn-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

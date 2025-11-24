<?php
include "../../koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM tamu ORDER BY idtamu DESC");
?>

<h2>Daftar Tamu</h2>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Nama Tamu</th>
        <th>No HP</th>
        <th>Jumlah</th>
        <th>Tujuan</th>
        <th>Asal</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_tamu']; ?></td>
            <td><?= $row['nohp']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['tujuan']; ?></td>
            <td><?= $row['asal']; ?></td>
            <td><?= $row['tanggal']; ?></td>
        </tr>
    <?php } ?>
</table>

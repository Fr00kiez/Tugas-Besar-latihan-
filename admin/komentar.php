<?php
include "../functions/database.php";
include "../templates/admin.header.php";

?>
<h2>Data Komentar</h2>
<!-- Tabel row data -->
<table class="table table-bordered">
    <!-- heading table -->
    <thead>
    <tr>
        <th>Id</th>
        <th>Nama User</th>
        <th>Isi</th>
        <th>Tanggal</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php
    // menarik data dari Database untuk ditampilkan ke dalam tabel!
    $stmt2 = $conn->prepare("SELECT k.idkomentar, k.isi, k.tanggal, p.nama FROM komentar k LEFT JOIN pelanggan p on k.pelanggan_idpelanggan = p.idpelanggan ORDER BY k.idkomentar DESC");
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    ?>
    <!-- body table -->
    <tbody>
    <?php while ($row = $stmt2->fetch()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['idkomentar']) ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo htmlspecialchars($row['isi']); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
            <td>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
include "../templates/admin.footer.php";
?>

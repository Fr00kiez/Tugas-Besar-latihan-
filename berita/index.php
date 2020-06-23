<?php
include "../session.php";
include "../functions/database.php";
$pth = "../";
include "../templates/header.php";

$id = $_GET['id'];

if (isset($_POST['isi'])) {
    $postCmt = $conn->prepare("INSERT INTO komentar (isi, tanggal, pelanggan_idpelanggan, berita_idtbl_berita) VALUES(:i, CURRENT_TIME(), :p, :b)");
    $postCmt->bindParam(":i", $_POST['isi']);
    $postCmt->bindParam(":p", $idpelanggan);
    $postCmt->bindParam(":b", $id);
    $postCmt->execute();
}

$detil = $conn->prepare("SELECT idberita, judul, ringkasan, tanggal, isi, wartawan_idwartawan FROM berita WHERE idberita = :bId");
$detil->bindParam(":bId", $id);
$detil->execute();
$detil->setFetchMode(PDO::FETCH_ASSOC);

$comments = $conn->prepare("SELECT k.isi, k.tanggal, p.nama FROM komentar k LEFT JOIN pelanggan p ON p.idpelanggan = k.pelanggan_idpelanggan WHERE berita_idtbl_berita = :bId");
$comments->bindParam(":bId", $id);
$comments->execute();
$comments->setFetchMode(PDO::FETCH_ASSOC);
?>
<section id="headline">
    <div class="row">
        <article class="berita" style="width: 100%;">
            <?php while ($row = $detil->fetch()): ?>
                <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                <?php
                // ambil ID wartawan, lalu ambil ke tabel wartawan supaya diambil nama wartawannya
                $idWartawan = $row['wartawan_idwartawan'];
                $wartawan = $conn->prepare("SELECT idwartawan, nama FROM wartawan WHERE idwartawan = $idWartawan");
                $wartawan->execute();
                $wartawan->setFetchMode(PDO::FETCH_ASSOC);
                while ($baris = $wartawan->fetch()):
                    ?>
                    <p>Wartawan: <?php echo htmlspecialchars($baris['nama']); ?>.
                        Jakarta, <?php echo htmlspecialchars($row['tanggal']); ?></p>
                <?php endwhile; ?>
                <p class="lead">
                    <?php echo htmlspecialchars($row['ringkasan']); ?>
                </p>
                <p><?php echo htmlspecialchars($row['isi']); ?></p>
            <?php endwhile; ?>
        </article>
    </div>
</section>
<section id="komentar">
    <h2 class="mb-3">Komentar</h2>
    <?php while ($c = $comments->fetch()) { ?>
        <div class="card p-3 mb-3">
            <div class="d-flex align-items-center mb-2">
                <div class="mr-2" style="width: 40px; height: 40px; background-color: #999; border-radius: 50%;"></div>
                <div>
                    <b class="d-block"><?php echo $c['nama']; ?></b>
                    <span style="font-size: 13px"><?php echo $c['tanggal']; ?></span>
                </div>
            </div>
            <p class="m-0"><?php echo $c['isi']; ?></p>
        </div>
    <?php } ?>
    <?php if (isset($user_check) && $user_check !== null) { ?>
        <form method="post" action="index.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="isi">Isi Komentar</label>
                <input class="form-control" type="text" id="isi" name="isi">
            </div>

            <!-- // pelanggan -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php } else { ?>
        <div class="alert alert-info">
            <span>Silakan login terlebih dahulu untuk mengirim komentar.</span>
        </div>
    <?php } ?>
</section>
<?php
include "../templates/footer.php";
?>

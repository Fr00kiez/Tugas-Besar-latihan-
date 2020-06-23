<?php
include"../functions/database.php";
include"../templates/admin.header.php";

$edit = null;
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM berita WHERE `idBerita` = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
                <?php if ($edit === null) { ?>
                <h2>Isi data Berita</h2>
                <?php } else { ?>
                <h2>Edit Berita</h2>
                <?php } ?>
                <form method="post" action="berita.php">
                    <input name="action" type="hidden" value="<?php echo $edit === null ? 'create' : 'update'; ?>">
                    <input name="idBerita" type="hidden" value="<?php echo $edit === null ? '' : $edit['idBerita']; ?>">
                    <div class="form-group">
                        <label for="tanggal">Tanggal dan waktu</label>
                        <input class="form-control" type="datetime-local" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input name="judul" type="text" class="form-control" id="judul" value="<?php echo $edit === null ? '' : $edit['judul']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan</label>
                        <input name="ringkasan" type="text" class="form-control" id="ringkasan" value="<?php echo $edit === null ? '' : $edit['ringkasan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Berita</label>
                        <textarea name="isi" class="form-control" id="isi" rows="3"><?php echo $edit === null ? '' : $edit['isi']; ?></textarea>
                    </div>
                    <!--    Relasi Wartawan ke Berita 
                            Oleh Karena itu, harus ada
                            id Wartawan, untuk menginformasikan
                            wartawan yang membuat berita ini

                            pada contoh ini, kita asumsikan
                            wartawan yang membuat berita
                            adalah wartawan dengan idwartawan
                            2
                    -->
                    <input type="hidden" id="wartawan_idwartawan" name="wartawan_idwartawan" value="2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
<?php
include"../templates/admin.footer.php";
?>
<?php
include"../functions/database.php";
include"../templates/admin.header.php";
// <!--   Untuk menghapus dan melakukan edit -->
$edit = null;
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM wartawan WHERE `idwartawan` = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
                <?php if ($edit === null) { ?>
                <h2>Isi data Wartawan Baru</h2>
                <?php } else { ?>
                <h2>Edit Wartawan</h2>
                <?php } ?>
                <form method="post" action="wartawan.php">
                    <input name="action" type="hidden" value="<?php echo $edit === null ? 'create' : 'update'; ?>">
                    <input name="idwartawan" type="hidden" value="<?php echo $edit === null ? '' : $edit['idwartawan']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input name="nama" type="text" class="form-control" id="nama" value="<?php echo $edit === null ? '' : $edit['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo $edit === null ? '' : $edit['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <br><input type="checkbox" onclick="lihatPass()">Show Password
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <script>
                function lihatPass(){
                    var x = document.getElementById("password");
                    x.type = (x.type === 'password' ? 'text' : 'password');
                }
                </script>
<?php
include"../templates/admin.footer.php";
?>
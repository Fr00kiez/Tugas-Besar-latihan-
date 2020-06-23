<?php
include"../functions/database.php";
include"../templates/admin.header.php";

if (isset($_POST['nama'])  && isset($_POST['email'])  && isset($_POST['password']))
{
    $stmt;

    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $stmt = $conn->prepare("INSERT INTO wartawan (nama, email, password) VALUES (:nama, :email, :password)");
    } else {
        $stmt = $conn->prepare("UPDATE wartawan SET nama = :nama, email = :email, password = :password WHERE idwartawan = :idwartawan");
        $stmt->bindParam(":idwartawan", $_POST['idwartawan']);
    }

    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt->execute();
}
?>
<h2>Data Wartawan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Passowrd</th>
            <th>Actions</th>
        </tr>    
    </thead>
    
<?php
$stmt2 = $conn->prepare("SELECT idwartawan, nama, email, password FROM wartawan ORDER BY idwartawan DESC");
$stmt2->execute();
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
?>
    <tbody>
        <?php while ($row = $stmt2->fetch()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['idwartawan']); ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
            <td>
            <!--   Untuk menghapus dan melakukan edit -->
                <a class="btn btn-secondary mr-2" href="isi-wartawan.php?id=<?php echo $row['idwartawan']; ?>">
                    Edit
                </a>
                <button class="btn btn-danger" onclick="
                    if (confirm('Apakah anda yakin ingin menghapus wartawan ini?')) {
                        window.location.href = 'delete-wartawan.php?id=<?php echo $row['idwartawan']; ?>';
                    }
                ">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
<?php
include"../templates/admin.footer.php";
?>

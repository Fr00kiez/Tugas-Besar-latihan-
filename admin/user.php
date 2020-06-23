<?php
include"../functions/database.php";
include"../templates/admin.header.php";

if (isset($_POST['email'])  && isset($_POST['password'])) {
    $stmt = $conn->prepare("INSERT INTO user ( email, password)
                            VALUES ( :email , :password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $email               = $_POST['email'];
    $password           = md5($_POST['password']);

    $stmt->execute();
}
?>
<h2>Users</h2>
<!-- Tabel row data -->
<table class="table table-bordered">
    <!-- heading table -->
    <thead>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Passowrd</th>
        </tr>    
    </thead>
<?php
// menarik data dari Database untuk ditampilkan ke dalam tabel!
$stmt2 = $conn->prepare("SELECT iduser, email,password FROM user ORDER BY iduser DESC");
$stmt2->execute();
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
?>
    <!-- body table -->
    <tbody>
        <?php while ($row = $stmt2->fetch()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['iduser']) ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php
include"../templates/admin.footer.php";
?>

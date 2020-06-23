<?php
include"../templates/admin.header.php";
?>
                <h2>Isi data User baru</h2>
                <form method="post" action="user.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <br><input type="checkbox" onclick="lihatPass()">Show Password
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <script>
                    function lihatPass() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                    x.type = "password";
                    }
                }
                </script>
<?php
include"../templates/admin.footer.php";
?>

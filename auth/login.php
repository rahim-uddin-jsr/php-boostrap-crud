<?php
require_once('../connectDb.php');
require_once('../header.php');
session_start();
if (isset($_POST['logout'])) {
    $loggedUser = "";
    $_SESSION["loggedin"] = false;
    session_destroy();
    header('crud/auth/login.php');
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php
            // Check if the form is submitted
            $loggedUser = "";

            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $l_query = "SELECT * FROM users WHERE username='$username'";
                $l_result = mysqli_query($data, $l_query);
                if ($l_result->num_rows > 0) {
                    while ($row = $l_result->fetch_assoc()) {
                        print_r($row);
                        $hashedPassword = $row['password'];
                        if (password_verify($password, $hashedPassword)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $loggedUser = $row['username'];
                            echo '<div class="alert alert-success" role="alert">Login successful!</div>';
                            // header('Location: /crud/auth/login.php');
                        } else {
                            $_SESSION["loggedin"] = false;
                            echo '<div class="alert alert-danger" role="alert">Invalid username or password!</div>';
                        }
                    }
                }
            }
            if (isset($_SESSION['loggedin'])) {
                echo "a";
            } else {
                echo "b";
            }
            ?>
            <h2 class="text-center mb-4">
                <?php
                if ($loggedUser) {
                    echo "Already logged in";
                }
                ?>
            </h2>
            <h5>
                <?php
                var_dump(isset($_POST['logout']));
                var_dump(isset($_POST['logout-submit']));
                if ($loggedUser) {
                    echo "Welcome $loggedUser";
                }

                ?>
            </h5>
            <?php
            if ($loggedUser == false) { ?>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" autocomplete="FALSE" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" autocomplete="FALSE" class="form-control" id="password" name="password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <?php
            } else {
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="logout" value="1">
                <button type="submit" name="logout-submit" class="btn btn-primary">Logout</button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once('../footer.php');
?>
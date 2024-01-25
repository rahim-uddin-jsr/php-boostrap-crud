<?php
include('../connectDb.php');
include('../header.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">User Registration</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Handle registration form submission
                $username = htmlspecialchars($_POST["username"]);
                $email = htmlspecialchars($_POST["email"]);
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $u_query = "INSERT INTO users(username,email,password) VALUES('$username','$$email','$password')";
                $u_result = mysqli_query($data, $u_query);
                if ($u_result) {
                    echo "INSERTED successfully";
                    header("Location: /crud/index.php");
                    echo '<div class="alert alert-success" role="alert">Registration successful!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Registration unsuccessful!</div>';
                    echo "bd update error";
                }
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
<?php
include('../footer.php')
?>
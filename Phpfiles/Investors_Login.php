<?php
session_start();
include("connection.php");  // Include the database connection file

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user data
    $sql = "SELECT * FROM login WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Check password
        if (password_verify($password, $row['Password'])) {
            // Check if user account status is "Active"
            if (isset($row['Status']) && $row['Status'] === 'active') {
                // Check if user is INVENTOR
                if (strtoupper($row['Usertype']) === 'INVENTOR') {
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['usertype'] = $row['Usertype'];
                    header("Location: Index.php");
                    exit();
                } else {
                    // Display alert if user type is not "INVENTOR"
                    echo '<script>alert("Only Inventors are allowed to login here.");</script>';
                }
            } else {
                // Display alert if account status is not "Active"
                echo '<script>alert("Your account is inactive. Please contact the admin.");</script>';
            }
        } else {
            // Display alert if password is incorrect
            echo '<script>alert("Invalid password.");</script>';
        }
    } else {
        // Display alert if email is not found
        echo '<script>alert("Invalid email address.");</script>';
    }
}
include("Nav.php");
?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">INVESTOR LOGIN</p>
            <p>Your Journey to Success <br> Starts Here</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                style="width: 100px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <img src="../assets/unsplash_JBwcenOuRCg.png" alt="" class="img-fluid">
        </div>
        <div class="col mt-5">
            <form action="" method="post">
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-7 mb-3">
                        <input type="email" class="form-control bg-light" placeholder="Your Email" name="email">
                    </div>
                </div>
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-7 mb-3">
                        <input type="text" class="form-control bg-light" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-6 text-center">
                        <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('Footer.php') ?>
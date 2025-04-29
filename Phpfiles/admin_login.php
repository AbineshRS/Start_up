<?php
session_start();

$adminEmail = "admin@.com";
$adminPassword = "admin123";
$error = "";

// Handle login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = "ADMIN";
        header("Location: admin_dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        $error = "Invalid admin email or password.";
    }
}
include("Nav.php");
?>

<div class="container text-center bg-light mt-5 p-5 ">
    <div class="row mt-5">
        <div class="col-md-5 mb-3">
            <img src="../assets/Group 66.png" alt="..." class="img-fluid w-25 h-auto">
            <div class="container bg-white text-center">
                <p class="pt-4">Login to your account</p>
                <form action="" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <label for="" class="float-start">Email</label>
                            <input type="text" class="form-control bg-light" placeholder="Email" name="email">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="float-start">Password</label>
                            <input type="text" class="form-control bg-light" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <a class="float-end text-decoration-underline" href="admin_reset_password.php">Forgot password?</a>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4 pb-4">
                        <div class="col-6 text-center">
                            <button class="btn btn-primary w-100" type="submit" name="login">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col">
            <img src="../assets/undraw_secure_login_pdn4 1.png" alt="" class="img-fluid">
        </div>
    </div>
</div>
<?php include('Footer.php') ?>
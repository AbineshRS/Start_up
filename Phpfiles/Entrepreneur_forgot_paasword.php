<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Check if the email exists
        $checkQuery = "SELECT * FROM login WHERE Email = '$email'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Update password
            $updateQuery = "UPDATE login SET Password = '$hashedPassword' WHERE Email = '$email'";
            if ($conn->query($updateQuery)) {
                echo "<script>alert('Password reset successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password.');</script>";
            }
        } else {
            echo "<script>alert('Email not found.');</script>";
        }
    }
}
?>

<?php include("Nav.php"); ?>

<div class="container text-center col-12 col-md-3 mt-3">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">REGISTER NOW</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Access Your World <br> of Innovation</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                style="width: 40px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<div class="container text-center mt-3">
    <div class="row">
        <div class="col">
            <img src="../assets/Rectangle 1011.png" alt="" class="img-fluid">
        </div>
        <div class="col-12 col-md-5 mt-5">
            <form method="post">
                <div class="row mb-3">
                    <input type="email" name="email" class="form-control bg-light" placeholder="Your Email" required>
                </div>
                <div class="row mb-3">
                    <input type="password" name="new_password" class="form-control bg-light" placeholder="New Password" required>
                </div>
                <div class="row mb-3">
                    <input type="password" name="confirm_password" class="form-control bg-light" placeholder="Confirm Password" required>
                </div>
                <div class="row mt-3">
                    <div class="col d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-primary w-100" name="submit">Reset Password</button>
                        <button type="reset" class="btn btn-primary w-100" name="reset">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

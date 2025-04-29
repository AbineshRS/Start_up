<?php
session_start();
include("connection.php");

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
            // Check if user is ENTREPRENEUR
            // Check if user is MENTOR
            // Check if user is MENTOR
            if (strtoupper($row['Usertype']) === 'MENTOR') {
                if (strtolower($row['Status']) === 'active') {
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['usertype'] = $row['Usertype'];
                    echo "<script>
                    alert('Login successful!');
                    window.location.href = 'mentor_home_page.php';
                </script>";
                    exit();
                } else {
                    echo "<script>alert('Your account is not active. Please contact the administrator.');</script>";
                }
            } else {
                echo "<script>alert('Only Mentors are allowed to login here.');</script>";
            }


        } else {
            echo '<div class="alert alert-danger text-center mt-3">Invalid password.</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center mt-3">Invalid email address.</div>';
    }
}

include("Nav.php");
?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">MENTOR LOGIN</p>
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
</div>
<div class="container text-center mt-5">
    <form action="" method="post">

        <div class="row mt-5">
            <div class="col-12 col-md-6 mb-5">
                <img src="../assets/image 24.png" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-4 ps-5 mt-5">
                <div class="row mb-3">
                    <input type="text" id="" class="form-control" placeholder="Your Email" name="email">
                </div>
                <div class="row mb-3">
                    <input type="text" id="" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="row mb-3">
                    <button class="btn btn-primary" type="submit" name="login">Login</button>
                </div>
            </div>
        </div>
    </form>

</div>
<?php include('Footer.php') ?>
<?php
session_start();
include("connection.php");

$adminEmail = "admin@startup.com"; // Use a valid admin email
$adminPassword = "admin123";       // Plain password (in production, hash and store in DB)

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Admin login check (case-insensitive)
    if (strtolower($email) === strtolower($adminEmail) && $password === $adminPassword) {
        $_SESSION['email'] = $adminEmail;
        $_SESSION['usertype'] = 'ADMIN';

        echo "<script>alert('Admin login successful!'); window.location.href = 'admin_dashboard.php';</script>";
        exit();
    }

    // User login check from database
    $sql = "SELECT * FROM login WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (strtolower($row['Status']) !== 'active') {
            echo "<script>alert('Your account is not active. Please contact the administrator.');</script>";
        } else {
            if (password_verify($password, $row['Password'])) {
                $_SESSION['email'] = $row['Email'];
                $_SESSION['RegId'] = $row['RegId'];
                $_SESSION['usertype'] = $row['Usertype'];

                $usertype = strtoupper($row['Usertype']);

                if ($usertype === 'ENTREPRENEUR') {
                    echo "<script>alert('Login successful!'); window.location.href = 'Entrepreneur_home.php';</script>";
                    exit();
                } elseif ($usertype === 'MENTOR') {
                    echo "<script>alert('Login successful!'); window.location.href = 'mentor_home_page.php';</script>";
                    exit();
                } elseif ($usertype === 'INVENTOR') {
                    echo "<script>alert('Login successful!'); window.location.href = 'Investors_home.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Unknown user type. Please contact support.');</script>";
                }
            } else {
                echo "<script>alert('Invalid password.');</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid email address.');</script>";
    }
}

include("Nav.php");
?>

<!-- Login UI -->
<div class="container text-center col-3 mt-3">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">LOGIN HERE</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Your Journey to Success <br> Starts Here</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                style="width: 40px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<div class="container text-center mt-5 mb-3">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <img src="../assets/Rectangle 10.png" alt="Login Illustration" class="img-fluid">
        </div>
        <div class="col-sm-6">
            <form method="post">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <input type="email" name="email" class="form-control border-0 bg-light px-4"
                            placeholder="Your Email" style="height: 55px;" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <input type="password" name="password" class="form-control border-0 bg-light px-4"
                            placeholder="Password" style="height: 55px;" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>
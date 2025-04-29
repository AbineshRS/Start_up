<?php include("Nav.php"); ?>
<style>
    .inp {
        background-color: #EEF9FF;
    }

    .up {
        background: #06A3DA;
    }
</style>

<body>
    <!-- Header Section -->
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

    <!-- Main Registration Form -->
    <div class="container text-center">
        <div class="row">
            <!-- Image Column -->
            <div class="col-lg-6 col-12 mb-4">
                <img src="../assets/image 6.png" alt="" class="img-fluid" style="width:90%">
            </div>

            <!-- Form Column -->
            <div class="col-lg-6 col-12 mt-lg-5">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    include("connection.php");

                    if (isset($_POST['submit'])) {
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $companyname = $_POST['companyname'];
                        $corporate_identification = $_POST['corporate_identification'];
                        $industy_select = $_POST['industy_select'];
                        $company_description = $_POST['company_description'];
                        $email = $_POST['email'];
                        $location = $_POST['location'];
                        $contact = $_POST['contact'];
                        $username = $_POST['username'];
                        $address = $_POST['address'];
                        $password = $_POST['password'];
                        $Confirm_Password = $_POST['Confirm_Password'];
                        $user_type = "ENTREPRENEUR";

                        if ($password !== $Confirm_Password) {
                            $alert_message = "Passwords do not match!";
                            $alert_type = "danger";
                        } else {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // Check if email already exists
                            $check = "SELECT * FROM login WHERE Email='$email'";
                            $result = $conn->query($check);

                            if ($result->num_rows > 0) {
                                $alert_message = "Email already exists.";
                                $alert_type = "warning";
                            } else {
                                // Insert into register table
                                $sql = "INSERT INTO `register` 
                                (`Firstname`, `Lastname`, `CompanyName`, `CorporateId`, `Industry_sector`, `Company_description`, 
                                `Location`, `Contactnumber`, `Address`, `Profile`) 
                                VALUES 
                                ('$firstname', '$lastname', '$companyname', '$corporate_identification', '$industy_select', 
                                '$company_description', '$location', '$contact', '$address', 'default_photo.jpg')";

                                if ($conn->query($sql) === TRUE) {
                                    $last_id = $conn->insert_id;

                                    // Insert into login table
                                    $login = "INSERT INTO `login`(`RegId`,`Email`,`Password`,`Usertype`,`username`,`Status`)
                                    VALUES ('$last_id', '$email', '$hashed_password', '$user_type', '$username', 'active')";

                                    if ($conn->query($login) === TRUE) {
                                        $alert_message = "Registration successful!";

                                        // Output JavaScript for alert and redirect
                                        echo "<script>
                                            alert('$alert_message');
                                            window.location.href = 'Login.php';
                                        </script>";
                                        exit();
                                    } else {
                                        $alert_message = "Login insert failed: " . $conn->error;
                                        $alert_type = "danger";
                                    }
                                } else {
                                    $alert_message = "Register insert failed: " . $conn->error;
                                    $alert_type = "danger";
                                }
                            }
                        }

                        if (!empty($alert_message)) {
                            echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">
                                ' . $alert_message . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    }
                    ?>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="First Name"
                                name="firstname" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Last Name"
                                name="lastname" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Company Name"
                                name="companyname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light"
                                placeholder="Corporate Identification Number" name="corporate_identification">
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select border-0 bg-light" name="industy_select">
                                <option selected disabled>Industry Sector</option>
                                <option value="IT">IT</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="finance">Finance</option>
                                <option value="real_estate">Real Estate</option>
                                <option value="retail_ecommerce">Retail & E-commerce</option>
                                <option value="food_beverage">Food & Beverage</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Company Description"
                                name="company_description">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control border-0 bg-light" placeholder="E-Mail ID"
                                name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Location"
                                name="location">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" class="form-control border-0 bg-light" placeholder="Contact Number"
                                name="contact" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Username"
                                name="username">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-0 bg-light" placeholder="Address"
                                name="address">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control border-0 bg-light" placeholder="Password"
                                name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="float-start">Profile</label>
                            <input type="file" class="form-control bg-light" name="profile">
                        </div>
                        <div class="col-md-6 mb-3" style="margin-top: 40px;">
                            <input type="password" class="form-control border-0 bg-light" placeholder="Confirm Password"
                                name="Confirm_Password" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Register Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include("Footer.php"); ?>
<?php include('Nav.php') ?>
<div class="container text-center mt-5">
    <div class="row mt-5">
        <div class="col">
            <img src="../assets/image 21.png" class="img-fluid" alt="...">
        </div>
        <div class="col">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <p class="text-primary fs-5">INVESTOR REGISTRATION</p>
                        <p>Access Your World <br> of Innovation</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100px; height: 3px;">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <form class="container" method="post" enctype="multipart/form-data">
                    <?php
                    include("connection.php");

                    if (isset($_POST['submit'])) {
                        $name = $_POST['Name'];
                        $Investing_category = $_POST['Investing_category'];
                        $contact = $_POST['contact'];
                        $Occupation = $_POST['Occupation'];
                        $Organization = $_POST['Organization'];
                        $Description = $_POST['Description'];
                        $Nationality = $_POST['Nationality'];
                        $address = $_POST['Address'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $Confirm_Password = $_POST['Confirm_Password'];
                        $user_type = "INVENTOR";

                        // File upload
                        $profileName = $_FILES['profile']['name'];
                        $profileTmp = $_FILES['profile']['tmp_name'];

                        $documentName = $_FILES['Upload_Document']['name'];
                        $documentTmp = $_FILES['Upload_Document']['tmp_name'];

                        $uploadDir = "../upload/";

                        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
                        $profileExt = strtolower(pathinfo($profileName, PATHINFO_EXTENSION));
                        $documentExt = strtolower(pathinfo($documentName, PATHINFO_EXTENSION));

                        if (!in_array($profileExt, $allowedTypes) || !in_array($documentExt, $allowedTypes)) {
                            $alert_message = "Invalid file type uploaded!";
                            $alert_type = "danger";
                        } elseif ($password !== $Confirm_Password) {
                            $alert_message = "Passwords do not match!";
                            $alert_type = "danger";
                        } else {
                            // Move uploaded files
                            move_uploaded_file($profileTmp, $uploadDir . $profileName);
                            move_uploaded_file($documentTmp, $uploadDir . $documentName);

                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // Check if email already exists
                            $check = "SELECT * FROM login WHERE Email='$email'";
                            $result = $conn->query($check);

                            if ($result->num_rows > 0) {
                                $alert_message = "Email already exists.";
                                $alert_type = "warning";
                            } else {
                                // Insert into register table
                                $sql = "INSERT INTO `inventor_register` 
                                (`Name`, `Investing_category`, `Contactnumber`, `Occupation`, `Organization`, `Description`, 
                                `Nationality`, `Address`, `Profile`, `Upload_Document`) 
                                VALUES 
                                ('$name', '$Investing_category', '$contact', '$Occupation', '$Organization', 
                                '$Description', '$Nationality', '$address', '$profileName', '$documentName')";

                                if ($conn->query($sql) === TRUE) {
                                    $last_id = $conn->insert_id;

                                    // Insert into login table
                                    $login = "INSERT INTO `login`(`RegId`,`Email`,`Password`,`Usertype`,`username`,`Status`)
                                    VALUES ('$last_id', '$email', '$hashed_password', '$user_type', '$email', 'active')";

                                    if ($conn->query($login) === TRUE) {
                                        $alert_message = "Registration successful!";
                                        $alert_type = "success";
                                        header("Location: Login.php");

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

                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="Name" class="form-control bg-light" placeholder="Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select bg-light" name="Investing_category" required>
                                <option value="" selected disabled>Investing category</option>
                                <option value="stocks">Stocks</option>
                                <option value="real_estate">Real Estate</option>
                                <option value="startups">Startups</option>
                                <option value="mutual_funds">Mutual Funds</option>
                                <option value="cryptocurrency">Cryptocurrency</option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <input type="email" class="form-control bg-light" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <input type="number" class="form-control bg-light" placeholder="Contact" name="contact"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light" placeholder="Occupation" name="Occupation"
                                required>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light" placeholder="Organization"
                                name="Organization" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light" placeholder="Description"
                                name="Description" required>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light" placeholder="Nationality"
                                name="Nationality" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light" placeholder="Address" name="Address"
                                required>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                        
                            <input type="password" class="form-control bg-light" placeholder="Password" name="password"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control bg-light" placeholder="Confirm Password"
                                name="Confirm_Password" required>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label for="" class="float-start">Profile</label>
                            <input type="file" class="form-control bg-light" name="profile" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="float-start">Document</label>
                            <input type="file" class="form-control bg-light" name="Upload_Document" required>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-6 text-center">
                            <button class="btn btn-primary w-100" type="submit" name="submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('Footer.php') ?>
<?php include('Nav.php') ?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">MENTOR REGISTRATION</p>
            <p>Access Your World <br> of Innovation</p>
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

<div class="container py-5">
    <form method="post" enctype="multipart/form-data" id="mentorForm">
        <?php
        include("connection.php");

        if (isset($_POST['submit'])) {
            $name = $_POST['Name'];
            $Expertise_area = $_POST['Expertise_area'];
            $Description = $_POST['Description'];
            $contact = $_POST['contact'];
            $Subscription_amount = $_POST['Subscription_amount'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $Confirm_Password = $_POST['Confirm_Password'];
            $user_type = "MENTOR";

            // Profile Image Upload
            $profileName = $_FILES['file']['name'];
            $profileTmp = $_FILES['file']['tmp_name'];
            $profileExt = strtolower(pathinfo($profileName, PATHINFO_EXTENSION));

            // Video Upload
            $videoName = $_FILES['demo_vedio']['name'];
            $videoTmp = $_FILES['demo_vedio']['tmp_name'];
            $videoExt = strtolower(pathinfo($videoName, PATHINFO_EXTENSION));

            $uploadDir = "../upload/";

            $allowedImageTypes = ['jpg', 'jpeg', 'png', 'pdf'];
            $allowedVideoTypes = ['mp4', 'webm', 'ogg'];

            if (!in_array($profileExt, $allowedImageTypes)) {
                $alert_message = "Invalid image file type!";
                $alert_type = "danger";
            } elseif (!in_array($videoExt, $allowedVideoTypes)) {
                $alert_message = "Invalid video file type!";
                $alert_type = "danger";
            } elseif ($password !== $Confirm_Password) {
                $alert_message = "Passwords do not match!";
                $alert_type = "danger";
            } else {
                move_uploaded_file($profileTmp, $uploadDir . $profileName);
                move_uploaded_file($videoTmp, $uploadDir . $videoName);

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $check = "SELECT * FROM login WHERE Email='$email'";
                $result = $conn->query($check);

                if ($result->num_rows > 0) {
                    $alert_message = "Email already exists.";
                    $alert_type = "warning";
                } else {
                    $sql = "INSERT INTO mentor_register 
                    (Name, Expertise_area, Description, contact, Subscription_amount, demo_vedio, Profile) 
                    VALUES 
                    ('$name', '$Expertise_area', '$Description', '$contact', '$Subscription_amount', 
                    '$videoName', '$profileName')";

                    if ($conn->query($sql) === TRUE) {
                        $last_id = $conn->insert_id;

                        $login = "INSERT INTO login(RegId,Email,Password,Usertype,username,Status)
                                  VALUES ('$last_id', '$email', '$hashed_password', '$user_type', '$email', 'active')";

                        if ($conn->query($login) === TRUE) {
                            echo "<script>
                              alert('Registration successful!');
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

        <div class="row justify-content-center text-center">
            <!-- Image -->
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <img src="../assets/image 22.png" alt="Registration Image" class="img-fluid">
            </div>

            <!-- Left -->
            <div class="col-12 col-md-3 mt-5">
                <div class="mb-3"><input type="text" class="form-control bg-light" placeholder="Name" name="Name"
                        required></div>
                <div class="mb-3"><input type="email" class="form-control bg-light" placeholder="E-Mail ID" name="email"
                        required></div>
                <div class="mb-5"><input type="text" class="form-control bg-light" placeholder="Contact Number"
                        name="contact" required></div>
                <div class="" style="margin-bottom: 30px;"><input type="password" class="form-control bg-light" placeholder="Password"
                        name="password" required></div>
                <div class="mb-3"><input type="password" class="form-control bg-light" placeholder="Confirm Password"
                        name="Confirm_Password" required></div>
            </div>

            <!-- Right -->
            <div class="col-12 col-md-4 mt-5">
                <div class="mb-3">
                    <select class="form-select bg-light" name="Expertise_area" required>
                        <option selected disabled>Expertise Area</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Mobile App Development">Mobile App Development</option>
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Data Science">Data Science</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                    </select>
                </div>
                <div class="mb-3"><input type="text" class="form-control bg-light" placeholder="Description"
                        name="Description" required></div>
                <div class="mb-3"><input type="text" class="form-control bg-light" placeholder="Subscription Amount"
                        name="Subscription_amount" required></div>

                <!-- Video Upload -->
                 <label for="" class="float-start">Video</label>
                <div class="mb-3">
                    <input type="file" class="form-control bg-light" name="demo_vedio"
                        accept="video/mp4,video/webm,video/ogg" required>
                </div>

                <!-- Profile Image Upload -->
                 <label for="" class="float-start">Profile</label>
                <div class="mb-3"><input type="file" class="form-control bg-light" name="file" required></div>

                <div class="text-center mt-4 col-12">
                    <button class="btn btn-primary px-4" type="submit" name="submit">Register</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Video Length Validation Script -->
<script>
    document.querySelector('input[name="demo_vedio"]').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const video = document.createElement('video');
            video.preload = 'metadata';

            video.onloadedmetadata = function () {
                window.URL.revokeObjectURL(video.src);
                const duration = video.duration;
                if (duration > 60) {
                    alert('Video should be 1 minute or less!');
                    document.querySelector('input[name="demo_vedio"]').value = '';
                }
            };

            video.src = URL.createObjectURL(file);
        }
    });
</script>

<?php include('Footer.php') ?>
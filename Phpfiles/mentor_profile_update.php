<?php
include("mentor_nav.php");
include('connection.php');

$userid = $_SESSION['RegId'];

// Process POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $expertise = $_POST['expertise'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $username = $_POST['username'] ?? '';
    $description = $_POST['description'] ?? '';
    $subscription = $_POST['subscription_amount'] ?? '';

    $demo = $_FILES['demo_video']['name'] ?? '';
    $demoTmp = $_FILES['demo_video']['tmp_name'] ?? '';
    $profile = $_FILES['profile_image']['name'] ?? '';
    $profileTmp = $_FILES['profile_image']['tmp_name'] ?? '';

    $uploadDir = "../upload/";

    // Upload profile image
    $profileUpdate = "";
    if (!empty($profile)) {
        move_uploaded_file($profileTmp, $uploadDir . $profile);
        $profileUpdate = ", Profile='$profile'";
    }

    // Upload demo video
    $demoUpdate = "";
    if (!empty($demo)) {
        move_uploaded_file($demoTmp, $uploadDir . $demo);
        $demoUpdate = ", demo_vedio='$demo'";
    }

    // Update mentor_register table
    $updateMentor = "UPDATE mentor_register SET 
        Name='$name',
        Expertise_area='$expertise',
        Description='$description',
        contact='$contact',
        Subscription_amount='$subscription'
        $profileUpdate
        $demoUpdate
        WHERE Id='$userid'";
    $conn->query($updateMentor);

}

// Fetch updated data
$sql = "SELECT 
    rg.Name, rg.Expertise_area, rg.Description, rg.contact, rg.Subscription_amount,
    rg.demo_vedio, rg.Profile, lg.Email, lg.username
    FROM mentor_register rg 
    INNER JOIN login lg ON rg.Id = lg.RegId 
    WHERE rg.Id = '$userid' AND lg.Usertype = 'MENTOR'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">UPDATE YOUR PROFILE</p>
            <p>Your Journey to Success <br> Starts Here</p>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" style="width: 100px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <form class="container" method="POST" enctype="multipart/form-data">
        <div class="row mt-3">
            <label for="imageUpload">
                <img id="profileImage" src="../upload/<?php echo $row['Profile']; ?>"
                    class="rounded mx-auto d-block border border-2" alt="Profile Image"
                    style="width: 30%; height: auto; cursor: pointer;">
            </label>
            <input type="file" name="profile_image" id="imageUpload" class="form-control mt-2 w-50 mx-auto"
                style="display: none;">
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="name" type="text" class="form-control bg-light" placeholder="Name"
                    value="<?php echo $row['Name']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <select name="expertise" class="form-select bg-light" required>
                    <option value="" disabled>Select Expertise</option>
                    <option value="One" <?php if ($row['Expertise_area'] === 'One')
                        echo 'selected'; ?>>One</option>
                    <option value="Two" <?php if ($row['Expertise_area'] === 'Two')
                        echo 'selected'; ?>>Two</option>
                    <option value="Three" <?php if ($row['Expertise_area'] === 'Three')
                        echo 'selected'; ?>>Three</option>
                </select>
            </div>
        </div>

    

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="username" type="text" class="form-control bg-light" placeholder="Username"
                    value="<?php echo $row['username']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="description" type="text" class="form-control bg-light" placeholder="Description"
                    value="<?php echo $row['Description']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="subscription_amount" type="text" class="form-control bg-light"
                    placeholder="Subscription Amount" value="<?php echo $row['Subscription_amount']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="demo_video" type="file" class="form-control bg-light">
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-6 text-center">
                <button class="btn btn-primary w-100" type="submit" name="submit">Update Profile</button>
            </div>
        </div>
    </form>
</div>

<?php include('Footer.php'); ?>
<?php
include('Entrepreneur_nav.php');
include('connection.php');
$userid = $_SESSION['RegId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $companyName = $_POST['company_name'];
    $corporateId = $_POST['corporate_id'];
    $industry = $_POST['industry_sector'];
    $description = $_POST['company_description'];
    $location = $_POST['location'];
    $contact = $_POST['contact_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Image upload handling
    $profileImage = $_FILES['profile_image']['name'];
    $tempImage = $_FILES['profile_image']['tmp_name'];
    $uploadDir = "../upload/";

    if (!empty($profileImage)) {
        move_uploaded_file($tempImage, $uploadDir . $profileImage);
        $imageUpdate = ", Profile='$profileImage'";
    } else {
        $imageUpdate = "";
    }

    // Update `register` table
    $updateRegister = "UPDATE register SET 
        FirstName='$firstName',
        LastName='$lastName',
        CompanyName='$companyName',
        CorporateId='$corporateId',
        Industry_sector='$industry',
        Company_description='$description',
        Location='$location',
        Contactnumber='$contact',
        Address='$address'
        $imageUpdate
        WHERE Id='$userid'";
    $conn->query($updateRegister);

    // Update `login` table
    $updateLogin = "UPDATE login SET 
        Email='$email',
        Username='$username'
        WHERE Id='$userid'";
    $conn->query($updateLogin);
}

$sql = "SELECT 
    rg.FirstName, rg.LastName, rg.CompanyName, rg.CorporateId, rg.Industry_sector,
    rg.Company_description, rg.Location, rg.Contactnumber, rg.Address, rg.Profile,
    lg.Username, lg.Email 
    FROM register rg 
    INNER JOIN login lg ON rg.Id = lg.RegId 
    WHERE rg.Id = '$userid' and lg.Usertype='ENTREPRENEUR'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">YOUR PROFILE</p>
            <p>Keep Your Profile Updated!</p>
        </div>
    </div>

    <form class="container" method="POST" enctype="multipart/form-data">
        <div class="row mt-3">
            <label for="imageUpload">
                <img id="profileImage" src="../upload/<?php echo $row['Profile']; ?>" class="rounded mx-auto d-block" alt="Profile Image"
                    style="width: 30%; height: auto; cursor: pointer;">
            </label>
            <input type="file" name="profile_image" id="imageUpload" class="d-none">
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="first_name" type="text" class="form-control bg-light" placeholder="First Name" value="<?php echo $row['FirstName']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="last_name" type="text" class="form-control bg-light" placeholder="Last Name" value="<?php echo $row['LastName']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="company_name" type="text" class="form-control bg-light" placeholder="Company Name" value="<?php echo $row['CompanyName']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="corporate_id" type="text" class="form-control bg-light" placeholder="Corporate Identification Number" value="<?php echo $row['CorporateId']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="industry_sector" type="text" class="form-control bg-light" placeholder="Industry Sector" value="<?php echo $row['Industry_sector']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="company_description" type="text" class="form-control bg-light" placeholder="Company Description" value="<?php echo $row['Company_description']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="email" type="email" class="form-control bg-light" placeholder="E-Mail ID" value="<?php echo $row['Email']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="location" type="text" class="form-control bg-light" placeholder="Location" value="<?php echo $row['Location']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="contact_number" type="text" class="form-control bg-light" placeholder="Contact Number" value="<?php echo $row['Contactnumber']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="username" type="text" class="form-control bg-light" placeholder="Username" value="<?php echo $row['Username']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <input name="address" type="text" class="form-control bg-light" placeholder="Address" value="<?php echo $row['Address']; ?>">
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-6 text-center">
                <button class="btn btn-primary w-100" type="submit">Update Profile</button>
            </div>
        </div>
    </form>
</div>

<?php include('Footer.php'); ?>

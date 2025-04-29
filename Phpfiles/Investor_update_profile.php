<?php
 include("Investors_nav.php");
include('connection.php');
$userid = $_SESSION['RegId'];

$errorMessages = [];  // Array to collect error messages

if (isset($_POST['submit'])) {
    $Name = $_POST['Name'];
    $Investing_category = $_POST['Investing_category'];
    $Contactnumber = $_POST['Contactnumber'];
    $Occupation = $_POST['Occupation'];
    $Organization = $_POST['Organization'];
    $Description = $_POST['Description'];
    $Nationality = $_POST['Nationality'];
    $Address = $_POST['Address'];
    $Upload_Document = $_POST['Upload_Document'];

    // Image upload handling
    $profileImage = $_FILES['profile_image']['name'];
    $tempImage = $_FILES['profile_image']['tmp_name'];
    $uploadDir = "../upload/";

    // Document upload handling
    $documentFile = $_FILES['document_file']['name'];
    $tempDocument = $_FILES['document_file']['tmp_name'];

    // Profile Image Upload
    if (!empty($profileImage)) {
        // Check for upload errors
        if ($_FILES['profile_image']['error'] === 0) {
            if (move_uploaded_file($tempImage, $uploadDir . $profileImage)) {
                $imageUpdate = ", Profile='$profileImage'";
            } else {
                $errorMessages[] = "Failed to move uploaded profile image.";
                $imageUpdate = "";
            }
        } else {
            $errorMessages[] = "Error uploading profile image: " . $_FILES['profile_image']['error'];
            $imageUpdate = "";
        }
    } else {
        $imageUpdate = "";
    }

    // Document Upload
    if (!empty($documentFile)) {
        // Check for upload errors
        if ($_FILES['document_file']['error'] === 0) {
            if (move_uploaded_file($tempDocument, $uploadDir . $documentFile)) {
                $documentUpdate = ", Upload_Document='$documentFile'";
            } else {
                $errorMessages[] = "Failed to move uploaded document.";
                $documentUpdate = "";
            }
        } else {
            $errorMessages[] = "Error uploading document: " . $_FILES['document_file']['error'];
            $documentUpdate = "";
        }
    } else {
        $documentUpdate = "";
    }

    // If there are no errors, update the database
    if (empty($errorMessages)) {
        // Update `inventor_register` table
        $updateRegister = "UPDATE inventor_register SET 
            Name='$Name',
            Investing_category='$Investing_category',
            Contactnumber='$Contactnumber',
            Occupation='$Occupation',
            Organization='$Organization',
            Description='$Description',
            Nationality='$Nationality',
            Address='$Address'
            $imageUpdate
            $documentUpdate
            WHERE id='$userid'";

        if ($conn->query($updateRegister)) {
            echo "Profile updated successfully!";
        } else {
            $errorMessages[] = "Failed to update profile in the database.";
        }
    }
}

// Fetch user data for the form
$sql = "SELECT * from inventor_register where id=$userid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- Form HTML Starts -->
<div class="container text-center">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">YOUR PROFILE</p>
            <p>Keep Your Profile Updated!</p>
        </div>
    </div>

    <form class="container" method="POST" enctype="multipart/form-data">
        <!-- Display Errors if Any -->
        <?php
        if (!empty($errorMessages)) {
            echo '<div class="alert alert-danger">';
            foreach ($errorMessages as $message) {
                echo "<p>$message</p>";
            }
            echo '</div>';
        }
        ?>

        <!-- Profile Image Upload -->
        <div class="row mt-3">
            <label for="imageUpload">
                <img id="profileImage" src="../upload/<?php echo $row['Profile']; ?>" class="rounded mx-auto d-block" alt="Profile Image"
                    style="width: 30%; height: auto; cursor: pointer;">
            </label>
            <input type="file" name="profile_image" id="imageUpload" class="d-none">
        </div>

        <!-- Form Fields -->
        <div class="row mt-4 justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="Name" type="text" class="form-control bg-light" placeholder="Name" value="<?php echo $row['Name']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="Investing_category" type="text" class="form-control bg-light" placeholder="Investing Category" value="<?php echo $row['Investing_category']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="Contactnumber" type="text" class="form-control bg-light" placeholder="Contact Number" value="<?php echo $row['Contactnumber']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="Occupation" type="text" class="form-control bg-light" placeholder="Occupation" value="<?php echo $row['Occupation']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="Organization" type="text" class="form-control bg-light" placeholder="Organization" value="<?php echo $row['Organization']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <textarea name="Description" class="form-control bg-light" placeholder="Description"><?php echo $row['Description']; ?></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <input name="Nationality" type="text" class="form-control bg-light" placeholder="Nationality" value="<?php echo $row['Nationality']; ?>">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input name="Address" type="text" class="form-control bg-light" placeholder="Address" value="<?php echo $row['Address']; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <input name="Upload_Document" type="text" class="form-control bg-light" placeholder="Upload Document" value="<?php echo $row['Upload_Document']; ?>">
            </div>
        </div>

        <!-- Document Display -->
        <?php if (!empty($row['Upload_Document'])): ?>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <label for="documentViewer">View Document:</label>
                    <!-- Check document file type and display accordingly -->
                    <?php
                    $documentExtension = pathinfo($row['Upload_Document'], PATHINFO_EXTENSION);
                    if ($documentExtension == 'pdf') {
                        echo '<iframe src="../upload/' . $row['Upload_Document'] . '" width="100%" height="400px"></iframe>';
                    } elseif (in_array($documentExtension, ['jpg', 'jpeg', 'png'])) {
                        echo '<img src="../upload/' . $row['Upload_Document'] . '" width="100%" height="auto">';
                    } else {
                        echo 'Unsupported document type.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Document Upload -->
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <input type="file" name="document_file" class="form-control bg-light" placeholder="Upload Document">
            </div>
        </div>

        <!-- Update Button -->
        <div class="row justify-content-center mt-4">
            <div class="col-6 text-center">
                <button class="btn btn-primary w-100" type="submit" name="submit">Update Profile</button>
            </div>
        </div>
    </form>
</div>

<?php include('Footer.php'); ?>

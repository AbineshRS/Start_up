<?php
include("Entrepreneur_nav.php");
include("connection.php");




$pid = $_SESSION['RegId']; // Assuming Pid is the session variable for logged-in user
$usertype=$_SESSION['usertype'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Handle file upload (photo)
    if ($_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $photo_path = "../upload/" . $photo;

        // Move uploaded photo to the server
        if (move_uploaded_file($photo_tmp_name, $photo_path)) {
            // Insert complaint into the database
            $sql = "INSERT INTO complaints (Pid, title, description, photo,usertype) VALUES (?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $pid, $title, $description, $photo,$usertype);

            if ($stmt->execute()) {
                echo "<script>alert('Complaint submitted successfully!');</script>";
            } else {
                echo "<script>alert('Failed to submit complaint. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Error uploading photo. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please choose a photo.');</script>";
    }
}

?>

<div class="container mt-5 col-6">
    <h2 class="text-primary text-center mb-5">Submit a Complaint</h2>
    
    <!-- Complaint Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success w-100" name="submit">Submit Complaint</button>
    </form>
</div>
<?php include("Footer.php"); ?>
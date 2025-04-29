<style>
    .cont {
        min-height: 600px;
    }
    .box {
        width: 70%;
        background-color: #D9F5FF;
        padding: 30px;
        border-radius: 10px;
    }
</style>
<?php  include("admin_nav.php"); ?>



<div class="container mt-5">
    <div class="text-center mb-4">
        <p class="fs-5 fw-semibold text-primary">Add Events</p>
        <p class="fw-bolder">Events</p>
        <div class="d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                style="width: 60px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
    <?php
// Make sure this code is above your form or at the top of the page
include("connection.php"); // your DB connection file (if needed)

if (isset($_POST['submit'])) {
    $eventname = $_POST['eventname'];
    $date = $_POST['date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $category = $_POST['category'];

    // File upload
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "../upload/" . $filename; // Make sure 'upload' folder exists

    // Move the uploaded file
    if (move_uploaded_file($tempname, $folder)) {
        // Insert data into database
        $query = "INSERT INTO Events (eventname, date, title, description, location, category, file)
                  VALUES ('$eventname', '$date', '$title', '$description', '$location', '$category', '$folder')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Event added successfully!');</script>";
        } else {
            echo "<script>alert('Error inserting data!');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image!');</script>";
    }
}
?>

    <div class="box mx-auto mb-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="eventname" class="form-label">Event Name</label>
                    <input type="text" name="eventname" id="eventname" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>
                <div class="col-12">
                    <label for="file" class="form-label">Photo</label>
                    <input type="file" name="file" id="file" class="form-control" accept="image/*" required>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" name="submit" class="btn btn-primary px-5">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("admin_footer.php") ?>

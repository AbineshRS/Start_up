<?php
include("mentor_nav.php");
include("connection.php"); // Your DB connection file

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (isset($_SESSION['RegId'])) {
        $Pid = $_SESSION['RegId'];

        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = str_replace(' ', '_', $_FILES['file']['name']);
            $fileName = preg_replace('/[^A-Za-z0-9.\-_]/', '', $fileName); // Sanitize file name

            // ✅ Correct upload folder
            $uploadDirectory = __DIR__ . '/../../start-up/upload/'; // <-- Notice the slash "/" here
            $uploadPath = $uploadDirectory . $fileName;

            // ✅ Create upload folder if it doesn't exist
            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            // ✅ Move the uploaded file
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // ✅ Save only the file name in DB
                $sql = "INSERT INTO blog (Pid, Title, Description, File) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $Pid, $title, $description, $fileName);
                $stmt->execute();

                echo "<script>alert('Added successfully!')</script>";
            } else {
                echo "<p class='text-danger'>Error moving uploaded file.</p>";
            }
        } else {
            echo "<p class='text-danger'>No file uploaded or upload error occurred.</p>";
        }
    } else {
        echo "<p class='text-danger'>User not logged in.</p>";
    }
}
?>

<style>
    .cont {
        background-color: #D9F5FF;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">Add Blog</p>
            <p>Shape Your Future</p>
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

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 cont">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label fs-5">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fs-5">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label fs-5">image</label>
                    <input type="file" name="file" class="form-control" id="file" accept="image/*" required>
                    </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Add Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Footer.php") ?>
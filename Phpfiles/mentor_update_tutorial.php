<?php include("mentor_nav.php") ?>
<style>
    .cont {
        background-color: #D9F5FF;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<?php
include("connection.php");

$id = $_GET['id'];

// Fetch existing tutorial data
$sql = "SELECT * FROM tutorail WHERE Id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<h4 class='text-center text-danger mt-4'>Tutorial not found.</h4>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $fileName = $row['File']; // Keep existing file name by default

    // Check if a new file is uploaded
    if (!empty($_FILES['file']['name'])) {
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileName = time() . "_" . basename($_FILES['file']['name']);
        move_uploaded_file($fileTmp, "../upload/" . $fileName);
    }

    // Update the tutorial
    $updateSql = "UPDATE tutorail SET Title = ?, Description = ?, File = ? WHERE Id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssi", $title, $description, $fileName, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Tutorial updated successfully.'); window.location.href='mentor_view_tutorial.php';</script>";
    } else {
        echo "<div class='text-danger text-center'>Failed to update tutorial.</div>";
    }

    $stmt->close();
}
?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">Update Tutorial</p>
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
                    <input type="text" name="title" class="form-control" id="title" required
                        value="<?php echo htmlspecialchars($row['Title']); ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fs-5">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4"
                        required><?php echo htmlspecialchars($row['Description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label fs-5"> File</label>
                    <input type="file" name="file" class="form-control" id="file" accept="video/*">
                    <?php if (!empty($row['File'])): ?>
                        <div class="mt-2">
                            <a href="../upload/<?php echo $row['File']; ?>" target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                View Current File
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Update Tutorial</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Footer.php") ?>

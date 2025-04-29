<style>
    .cont {
        min-height: 600px;
    }
</style>
<?php include("admin_nav.php"); ?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View All</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Blog</p>
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

<div class="container mt-3 p-3 cont">
    <div class="table-responsive">
        <?php
        include("connection.php");

        // Fetch all blog posts
        $sql = "SELECT * FROM blog ORDER BY Id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Title</th>
                        <th style="min-width: 200px;">Description</th>
                        <th style="min-width: 150px;">File</th>
                        <th style="min-width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="text-break"><?php echo $row['Title']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td>
                                <a href="../upload/<?php echo $row['File']; ?>" target="_blank">
                                    View File
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Toggle Button -->
                                    <form method="post" action="admin_view_blog.php?id=<?php echo $row['Id']; ?>" class="me-2">
                                        <button type="submit" name="toggle" class="btn <?php echo ($row['Status'] == 0) ? 'btn-danger' : 'btn-success'; ?> btn-sm">
                                            <?php echo ($row['Status'] == 0) ? 'Reject' : 'Approve'; ?>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>No blogs found</h4>";
        }
        ?>
    </div>
</div>

<?php include('admin_footer.php'); ?>

<?php
// Handle Toggle actions (Approve/Reject)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the blog ID from the URL
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        // Get the current status of the blog from the database
        $result = $conn->query("SELECT Status FROM blog WHERE Id = $id");
        $row = $result->fetch_assoc();

        if ($row) {
            $currentStatus = $row['Status'];

            // Toggle the status: If it's 0 (approved), set it to 1 (rejected); if it's 1 (rejected), set it to 0 (approved)
            $newStatus = ($currentStatus == 0) ? 1 : 0;

            // Update the blog status in the database
            $updateSql = "UPDATE blog SET Status = $newStatus WHERE Id = $id";
            if ($conn->query($updateSql) === TRUE) {
                // Redirect back to the same page with a success message
                echo "<script>
                        alert('Blog status updated');
                        window.location.href = 'admin_view_blog.php';  // Redirect back to blog list
                      </script>";
            } else {
                echo "Error updating status: " . $conn->error;
            }
        }
    }
}
?>

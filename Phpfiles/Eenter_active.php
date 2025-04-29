<?php
include("connection.php");

$id = $_GET['id'] ?? null;
if ($id) {
    $Id = intval($id);

    $sql = "SELECT 
        mg.FirstName,
        mg.CompanyName,
        mg.Location,
        mg.Contactnumber,
        mg.Profile
    FROM 
        register mg 
    INNER JOIN 
        login l 
    ON 
        mg.Id = l.RegId 
    WHERE 
        mg.Id = '$Id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
        exit;
    }

    $conn->close();
} else {
    echo "No ID provided in URL";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("connection.php");

    if (isset($_POST['accept'])) {
        $status = 'active';
    } elseif (isset($_POST['reject'])) {
        $status = 'inactive';
    }

    if (isset($status)) {
        $updateSql = "UPDATE login SET status = '$status' WHERE RegId = '$Id' AND Usertype='ENTREPRENEUR'";
        
        if ($conn->query($updateSql) === TRUE) {
            // Redirect with name and status
            header("Location: {$_SERVER['PHP_SELF']}?id=$Id&status_updated=$status&name=" . urlencode($row['FirstName']));
            exit;
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}

include("admin_nav.php");
?>

<!-- Show JavaScript Alert if status updated -->
<?php if (isset($_GET['status_updated']) && isset($_GET['name'])): ?>
<script>
    alert("<?php echo htmlspecialchars($_GET['name']); ?> status successfully updated to <?php echo htmlspecialchars($_GET['status_updated']); ?>!");
</script>
<?php endif; ?>

<div class="container bg-light mt-5 mb-5 py-5">
    <div class="row g-4 text-center text-md-start align-items-start">

        <!-- Profile Section -->
        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <img src="../upload/<?php echo $row['Profile']; ?>" alt="Profile Image"
                class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
            <p class="fs-3 mt-2"><?php echo $row['FirstName']; ?></p>
        </div>

        <!-- Left Info Column -->
        <div class="col-12 col-md-4">
            <p class="text-primary fw-bold">E-Mail</p>
            <p><?php echo $row['FirstName']; ?></p>

            <p class="text-primary fw-bold">Expertise Category</p>
            <p><?php echo $row['CompanyName']; ?></p>

            <p class="text-primary fw-bold">Contact No</p>
            <p><?php echo $row['Location']; ?></p>

            <p class="text-primary fw-bold">Subscription Amount</p>
            <p><?php echo $row['Contactnumber']; ?></p>
        </div>

        <!-- Accept/Reject Buttons -->
        <form method="post">
            <div class="d-flex gap-2">
                <button class="btn btn-success w-50" type="submit" name="accept">Accept</button>
                <button class="btn btn-danger w-50" type="submit" name="reject">Reject</button>
            </div>
        </form>

    </div>
</div>

<?php include('admin_footer.php'); ?>

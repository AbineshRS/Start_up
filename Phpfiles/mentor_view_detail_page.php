<?php
include("connection.php");

if (isset($_GET['id'])) {
    $Id = intval($_GET['id']);

    $sql = "SELECT 
        mg.Name,
        mg.Contact,
        mg.Expertise_area,
        mg.Subscription_amount,
        mg.Description,
        mg.Profile,
        mg.demo_vedio,
        l.Email 
    FROM 
        mentor_register mg 
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
        $email = $row['Email']; // Get email from the joined result
        $updateSql = "UPDATE login SET status = '$status' WHERE Email = '$email'";
        
        if ($conn->query($updateSql) === TRUE) {
            header("Location: {$_SERVER['PHP_SELF']}?id=$Id&status_updated=$status");
            exit;
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}    

include("admin_nav.php");
?>

<div class="container bg-light mt-5 mb-5 py-5">
    <div class="row g-4 text-center text-md-start align-items-start">
        
        <!-- Profile Section -->
        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <img src="../upload/<?php echo $row['Profile']; ?>" alt="Profile Image"
                class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
            <p class="fs-3 mt-2"><?php echo $row['Name']; ?></p>
        </div>

        <!-- Left Info Column -->
        <div class="col-12 col-md-4">
            <p class="text-primary fw-bold">E-Mail</p>
            <p><?php echo $row['Email']; ?></p>

            <p class="text-primary fw-bold">Expertise Category</p>
            <p><?php echo $row['Expertise_area']; ?></p>

            <p class="text-primary fw-bold">Contact No</p>
            <p><?php echo $row['Contact']; ?></p>

            <p class="text-primary fw-bold">Subscription Amount</p>
            <p><?php echo $row['Subscription_amount']; ?></p>

            <p class="text-primary fw-bold">Description</p>
            <p><?php echo $row['Description']; ?></p>
        </div>

        <!-- Right Info Column -->
<div class="col-12 col-md-4" style="padding-left: 10px;"> <!-- Shift left -->
    <div class="mb-3">
        <p class="text-primary fw-bold">Demo Video</p>
        <div class="ratio ratio-16x9">
            <video controls>
                <source src="../upload/<?php echo $row['demo_vedio']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <!-- Buttons in one row -->
    <form method="post">
        <div class="d-flex gap-2">
            <button class="btn btn-success w-50" type="submit" name="accept">Accept</button>
            <button class="btn btn-danger w-50" type="submit" name="reject">Reject</button>
        </div>
    </form>
</div>

    </div>
</div>

<?php include('admin_footer.php') ?>

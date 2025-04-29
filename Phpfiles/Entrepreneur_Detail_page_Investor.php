<?php
include("Entrepreneur_nav.php");
include("connection.php"); // Include your database connection file

// Check if session variable 'RegId' is set
if (!isset($_SESSION['RegId'])) {
    echo "<h4 class='text-center mt-5'>You are not logged in!</h4>";
    exit; // Stop execution if the user is not logged in
}

// Fetch investor details from the database
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Assuming you are passing an 'id' in the URL for the investor

    // SQL query to get investor details based on the ID
    $sql = "SELECT rg.id, rg.Profile, rg.Name, lg.Email, rg.Contactnumber, rg.Description, rg.Nationality,
            rg.Address, rg.Occupation, rg.Investing_category, rg.Organization
            FROM inventor_register rg 
            INNER JOIN login lg ON rg.id = lg.RegId 
            WHERE rg.id = ? AND lg.Usertype = 'INVENTOR'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if investor exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc(); // Fetch the data
    } else {
        echo "<h4 class='text-center mt-5'>Investor not found!</h4>";
        exit;
    }
} else {
    echo "<h4 class='text-center mt-5'>No investor selected!</h4>";
    exit;
}

// Check if the entrepreneur has already sent a request to this investor
$alreadyRequested = false;
$requestStatus = null; // Default to null for no status

$checkRequestSql = "SELECT Status FROM requestinvestor WHERE EntrepreneurId = ? AND InvestorsId = ?";
$stmtCheck = $conn->prepare($checkRequestSql);
$stmtCheck->bind_param("ii", $_SESSION['RegId'], $row['id']);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    $requestRow = $resultCheck->fetch_assoc();
    $alreadyRequested = true;
    $requestStatus = $requestRow['Status']; // Fetch the status of the request
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    if (!$alreadyRequested) { // Only insert if not already requested
        $entrepreneurId = $_SESSION['RegId'];  // Entrepreneur's ID from the session
        $investorId = $row['id'];  // Investor's ID from the database
        $status = 0;  // Default status is Pending

        // Insert the request into the requestinvestor table
        $insertSql = "INSERT INTO requestinvestor (EntrepreneurId, InvestorsId, Status) VALUES (?, ?, ?)";
        $stmtInsert = $conn->prepare($insertSql);
        $stmtInsert->bind_param("iii", $entrepreneurId, $investorId, $status);

        if ($stmtInsert->execute()) {
            echo "<script>alert('Request Sent Successfully!'); window.location.href='Entrepreneur_view_event.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to send request. Try again.');</script>";
        }
    } else {
        echo "<script>alert('You have already sent a request!');</script>";
    }
}
?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">INVESTOR DETAILS</p>
            <p>Your Ideas, Our Mission</p>
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

<div class="container text-center bg-light">
    <div class="row p-5">
        <div class="col-md-4">
            <img src="../upload/<?php echo htmlspecialchars($row['Profile']); ?>" alt="" class="img-fluid rounded-circle">
            <p><?php echo htmlspecialchars($row['Name']); ?></p> <!-- Displaying full name -->
        </div>
        <div class="col-md-8">
            <form action="" method="post">
                <div class="row mt-6 justify-content-center">
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start mb-1">E-Mail</p>
                        <p class="text-start mt-3 mb-0"><?php echo htmlspecialchars($row['Email']); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Organization</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Organization']); ?></p>
                    </div>
                </div>
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Investing Category</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Investing_category']); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Description</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Description']); ?></p>
                    </div>
                </div>
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Contact No</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Contactnumber']); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Occupation</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Occupation']); ?></p>
                    </div>
                </div>
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Address</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Address']); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-primary text-start">Nationality</p>
                        <p class="text-start mt-3"><?php echo htmlspecialchars($row['Nationality']); ?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
    <?php if ($alreadyRequested): ?>
        <?php
            // Check if the request status is 1 (accepted)
            $statusSql = "SELECT Status FROM requestinvestor WHERE EntrepreneurId = ? AND InvestorsId = ?";
            $stmtStatus = $conn->prepare($statusSql);
            $stmtStatus->bind_param("ii", $_SESSION['RegId'], $row['id']);
            $stmtStatus->execute();
            $resultStatus = $stmtStatus->get_result();
            $statusRow = $resultStatus->fetch_assoc();

            if ($statusRow['Status'] == 1): // If the status is 1 (accepted)
        ?>
            <p class="alert alert-success font-weight-bold text-center" style="background-color: #28a745; color: white; font-size: 18px;">
                The investor has accepted your request! 🎉
            </p>
        <?php else: ?>
            <p class="alert alert-warning font-weight-bold text-center" style="background-color: #ffc107; color: white; font-size: 18px;">
                You have already sent a request but it is still pending.
            </p>
        <?php endif; ?>
    <?php else: ?>
        <button type="submit" class="btn btn-success col-4" name="submit">Request</button>
    <?php endif; ?>
</div>

            </form>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

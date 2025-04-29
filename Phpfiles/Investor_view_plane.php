<?php include("Investors_nav.php"); ?>

<style>
    .box {
        background-color: #EEF9FF;
        padding: 20px;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .box {
            padding: 10px;
        }
    }
</style>

<div class="container text-center mt-5 mb-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">Request</p>
            <p class="fw-bolder"></p>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-auto">
            <div class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                style="width: 40px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<?php
include("connection.php");

$Id = $_GET['pitchid'];
$Id2 = $_GET['requestid'];

// Handle Accept
if (isset($_GET['accept'])) {
    $update = "UPDATE requestinvestor SET Status = 1 WHERE Id = $Id2";
    if ($conn->query($update) === TRUE) {
        echo "<script>alert('Request Accepted Successfully!'); window.location.href='Investor_Entrepreneur_request.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle Reject
if (isset($_GET['reject'])) {
    $update = "UPDATE requestinvestor SET Status = 0 WHERE Id = $Id2";
    if ($conn->query($update) === TRUE) {
        echo "<script>alert('Request Rejected Successfully!'); window.location.href='Investor_Entrepreneur_request.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch and display startup entries
$sql = "SELECT * FROM startup_pitch WHERE PitchId = $Id ORDER BY PitchId DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="container mb-4">
            <div class="box g-4">
                <p class="text-start fw-semibold"><?php echo $row['CompanyName']; ?></p>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <p class="text-primary">Company Name:</p>
                        <p><?php echo $row['CompanyName']; ?></p>
                        <p class="text-primary">Audience:</p>
                        <p><?php echo $row['Audience']; ?></p>
                        <p class="text-primary">Problem:</p>
                        <p><?php echo $row['Problem']; ?></p>
                        <p class="text-primary">Secret Sauce:</p>
                        <p><?php echo $row['SecretSauce']; ?></p>
                        <p class="text-primary">Defined Market:</p>
                        <p><?php echo $row['DefinedMarket']; ?></p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p class="text-primary">Market Value:</p>
                        <p><?php echo $row['MarketValue']; ?></p>
                        <p class="text-primary">Competitor 1:</p>
                        <p><?php echo $row['Competitor1']; ?></p>
                        <p class="text-primary">Competitor 2:</p>
                        <p><?php echo $row['Competitor2']; ?></p>
                        <p class="text-primary">Differentiator:</p>
                        <p><?php echo $row['Differentiator']; ?></p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p class="text-primary">Current State:</p>
                        <p><?php echo $row['CurrentState']; ?></p>
                        <p class="text-primary">Ask:</p>
                        <p><?php echo $row['Ask']; ?></p>
                        <p class="text-primary">Help Purpose:</p>
                        <p><?php echo $row['HelpPurpose']; ?></p>
                        <p class="text-primary">Equity Offering:</p>
                        <p><?php echo $row['EquityOffering']; ?></p>

                        <?php
                        // Fetch the current status of the request
                        $statusSql = "SELECT Status FROM requestinvestor WHERE Id = $Id2";
                        $statusResult = $conn->query($statusSql);
                        $statusRow = $statusResult->fetch_assoc();
                        $status = $statusRow['Status'];
                        ?>

                        <div class="d-grid gap-2 mt-3">
                            <?php if ($status == 1) { ?>
                                <!-- Already Accepted, show only Reject button -->
                                <a href="?pitchid=<?php echo $Id; ?>&requestid=<?php echo $Id2; ?>&reject=1" class="btn btn-danger">Reject Request</a>
                            <?php } elseif ($status == 0) { ?>
                                <!-- Already Rejected, show only Accept button -->
                                <a href="?pitchid=<?php echo $Id; ?>&requestid=<?php echo $Id2; ?>&accept=1" class="btn btn-success">Accept Request</a>
                            <?php } else { ?>
                                <!-- No decision yet, show both -->
                                <a href="?pitchid=<?php echo $Id; ?>&requestid=<?php echo $Id2; ?>&accept=1" class="btn btn-success">Accept Request</a>
                                <a href="?pitchid=<?php echo $Id; ?>&requestid=<?php echo $Id2; ?>&reject=1" class="btn btn-danger">Reject Request</a>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<h4 class='text-center mb-5'>No startups found</h4>";
}
?>

<?php include("Footer.php"); ?>

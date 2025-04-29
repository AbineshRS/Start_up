<?php include('Entrepreneur_nav.php'); ?>
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
            <p class="fs-5 fw-semibold text-primary">CREATE YOUR STARTUP</p>
            <p class="fw-bolder">Your big opportunity may be right <br> where you are now</p>
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

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $pitchId = (int)$_POST['PitchId'];
    $deleteSql = "UPDATE startup_pitch SET Status = 1 WHERE PitchId = $pitchId";
    if ($conn->query($deleteSql)) {
        echo "<script>alert('Startup marked as deleted.'); window.location.href=window.location.href;</script>";
    } else {
        echo "<p class='text-danger text-center'>Error deleting: " . $conn->error . "</p>";
    }
}

// Fetch and display startup entries
$Id = $_SESSION['RegId'];
$sql = "SELECT * FROM startup_pitch WHERE RegId=$Id  and  Status != 1 ORDER BY PitchId DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="container mb-4">
            <form method="post" action="">
                <input type="hidden" name="PitchId" value="<?php echo $row['PitchId']; ?>">
                <p class="text-start fw-semibold"><?php echo $row['CompanyName']; ?></p>
                <div class="row box g-4">
                    <div class="col-12 col-md-4">
                        <p class="text-primary">Company Name:</p>
                        <p><?php echo $row['CompanyName']; ?></p>
                        <p class="text-primary">Audience:</p>
                        <p><?php echo $row['Audience']; ?></p>
                        <p class="text-primary">Problem:</p>
                        <p><?php echo $row['Problem']; ?></p>
                        <p class="text-primary">SecretSauce:</p>
                        <p><?php echo $row['SecretSauce']; ?></p>
                        <p class="text-primary">DefinedMarket:</p>
                        <p><?php echo $row['DefinedMarket']; ?></p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p class="text-primary">MarketValue:</p>
                        <p><?php echo $row['MarketValue']; ?></p>
                        <p class="text-primary">Competitor1:</p>
                        <p><?php echo $row['Competitor1']; ?></p>
                        <p class="text-primary">Competitor2:</p>
                        <p><?php echo $row['Competitor2']; ?></p>
                        <p class="text-primary">Differentiator:</p>
                        <p><?php echo $row['Differentiator']; ?></p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p class="text-primary">CurrentState:</p>
                        <p><?php echo $row['CurrentState']; ?></p>
                        <p class="text-primary">Ask:</p>
                        <p><?php echo $row['Ask']; ?></p>
                        <p class="text-primary">HelpPurpose:</p>
                        <p><?php echo $row['HelpPurpose']; ?></p>
                        <p class="text-primary">EquityOffering:</p>
                        <p><?php echo $row['EquityOffering']; ?></p>

                        <a href="Entrepreneur_view_all_Investors.php" class="btn btn-primary w-100 mb-3">
                            Request an Investor
                        </a>

                        <div class="d-flex justify-content-between gap-2">
                            <a href="Entrepreneur_edit_plane.php?id=<?php echo $row['PitchId']; ?>" class="btn btn-primary w-50">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button type="submit" name="delete" class="btn btn-danger w-50" onclick="return confirm('Are you sure you want to delete this startup?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
} else {
    echo "<h4 class='text-center mb-5'>No startups found</h4>";
}
?>

<?php include("Footer.php"); ?>

<?php
include("Entrepreneur_nav.php");
include("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data
    $sql = "SELECT * FROM startup_pitch WHERE PitchId = $id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<h4 class='text-center mt-5'>Startup not found!</h4>";
        exit;
    }
}

// Update logic
if (isset($_POST['update'])) {
    $companyName = $_POST['CompanyName'];
    $audience = $_POST['Audience'];
    $problem = $_POST['Problem'];
    $secretSauce = $_POST['SecretSauce'];
    $definedMarket = $_POST['DefinedMarket'];
    $marketValue = $_POST['MarketValue'];
    $competitor1 = $_POST['Competitor1'];
    $competitor2 = $_POST['Competitor2'];
    $differentiator = $_POST['Differentiator'];
    $currentState = $_POST['CurrentState'];
    $ask = $_POST['Ask'];
    $helpPurpose = $_POST['HelpPurpose'];
    $equityOffering = $_POST['EquityOffering'];

    $updateSql = "UPDATE startup_pitch SET
        CompanyName='$companyName',
        Audience='$audience',
        Problem='$problem',
        SecretSauce='$secretSauce',
        DefinedMarket='$definedMarket',
        MarketValue='$marketValue',
        Competitor1='$competitor1',
        Competitor2='$competitor2',
        Differentiator='$differentiator',
        CurrentState='$currentState',
        Ask='$ask',
        HelpPurpose='$helpPurpose',
        EquityOffering='$equityOffering'
        WHERE PitchId=$id";

    if ($conn->query($updateSql)) {
        echo "<script>alert('Startup updated successfully!'); window.location.href='Entrepreneur_update_plane.php';</script>";
    } else {
        echo "<p class='text-danger text-center'>Error updating: " . $conn->error . "</p>";
    }
}
?>

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

<div class="container mt-5">
    <div class="text-center mb-4">
        <p class="fs-5 fw-semibold text-primary">EDIT YOUR STARTUP</p>
        <p class="fw-bolder">Update your vision with better clarity</p>
    </div>

    <form method="POST">
        <div class="row box g-4">
            <div class="col-12 col-md-4">
                <label class="text-primary">Company Name:</label>
                <input type="text" name="CompanyName" value="<?php echo $row['CompanyName']; ?>" required class="form-control">

                <label class="text-primary mt-3">Audience:</label>
                <input type="text" name="Audience" value="<?php echo $row['Audience']; ?>" class="form-control">

                <label class="text-primary mt-3">Problem:</label>
                <textarea name="Problem" class="form-control"><?php echo $row['Problem']; ?></textarea>

                <label class="text-primary mt-3">Secret Sauce:</label>
                <input type="text" name="SecretSauce" value="<?php echo $row['SecretSauce']; ?>" class="form-control">

                <label class="text-primary mt-3">Defined Market:</label>
                <input type="text" name="DefinedMarket" value="<?php echo $row['DefinedMarket']; ?>" class="form-control">
            </div>

            <div class="col-12 col-md-4">
                <label class="text-primary">Market Value:</label>
                <input type="text" name="MarketValue" value="<?php echo $row['MarketValue']; ?>" class="form-control">

                <label class="text-primary mt-3">Competitor 1:</label>
                <input type="text" name="Competitor1" value="<?php echo $row['Competitor1']; ?>" class="form-control">

                <label class="text-primary mt-3">Competitor 2:</label>
                <input type="text" name="Competitor2" value="<?php echo $row['Competitor2']; ?>" class="form-control">

                <label class="text-primary mt-3">Differentiator:</label>
                <input type="text" name="Differentiator" value="<?php echo $row['Differentiator']; ?>" class="form-control">
            </div>

            <div class="col-12 col-md-4">
                <label class="text-primary">Current State:</label>
                <input type="text" name="CurrentState" value="<?php echo $row['CurrentState']; ?>" class="form-control">

                <label class="text-primary mt-3">Ask:</label>
                <input type="text" name="Ask" value="<?php echo $row['Ask']; ?>" class="form-control">

                <label class="text-primary mt-3">Help Purpose:</label>
                <input type="text" name="HelpPurpose" value="<?php echo $row['HelpPurpose']; ?>" class="form-control">

                <label class="text-primary mt-3">Equity Offering:</label>
                <input type="text" name="EquityOffering" value="<?php echo $row['EquityOffering']; ?>" class="form-control">

                <button type="submit" name="update" class="btn btn-primary w-100 mt-4">
                     Update Startup
                </button>
            </div>
        </div>
    </form>
</div>

<?php include("Footer.php"); ?>

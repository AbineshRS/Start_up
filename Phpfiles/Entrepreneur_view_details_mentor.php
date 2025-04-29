<!-- Add custom styles -->
<style>
    .fixed-box {
        height: 180px;
        overflow: auto;
    }
</style>

<?php
include("Entrepreneur_nav.php");
include("connection.php");

$id = $_GET['id'];

// Fetch mentor data from mentor_register table
$query = "SELECT * FROM mentor_register WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">MENTOR Details</p>
            <p>Access Your World <br> of Innovation</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                style="width: 100px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Display Boxes in Two Columns -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center g-4">
        <!-- Column 1 -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light border rounded fixed-box">
                <h6>Name</h6>
                <p class="text-muted"><?= $data['Name'] ?></p>
            </div>
            <div class="p-3 bg-light border rounded mt-3 fixed-box">
                <h6>Contact</h6>
                <p class="text-muted"><?= $data['contact'] ?></p>
            </div>
            <div class="p-3 bg-light border rounded mt-3 fixed-box">
                <h6>Expertise Area</h6>
                <p class="text-muted"><?= $data['Expertise_area'] ?></p>
            </div>
        </div>

        <!-- Column 2 -->
        <div class="col-12 col-md-6">
            <div class="p-3 bg-light border rounded fixed-box">
                <h6>Description</h6>
                <p class="text-muted"><?= $data['Description'] ?></p>
            </div>
            <div class="p-3 bg-light border rounded mt-3 fixed-box">
                <h6>Subscription Amount</h6>
                <p class="text-muted">₹<?= $data['Subscription_amount'] ?></p>
            </div>
            <div class="p-3 bg-light border rounded mt-3 fixed-box">
                <h6>Demo Video</h6>
                <div class="text-center">
                    <a href="../upload/<?= $data['demo_vedio'] ?>" class="btn btn-sm col-6 mt-3 btn-outline-primary"
                        target="_blank">
                        Watch Video
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <a href="mentor_payment_page.php?amount=<?= $data['Subscription_amount'] ?>&mentor_id=<?= $data['id'] ?>"
            class="btn btn-success btn-lg col-6 text-center">
            Subscribe
        </a>
    </div>
</div>

<?php include("Footer.php"); ?>
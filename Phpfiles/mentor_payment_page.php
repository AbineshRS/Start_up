<?php
include("Entrepreneur_nav.php");
include("connection.php");

$mentorId = $_GET['mentor_id'] ?? null;
$amount = $_GET['amount'] ?? '0';
$entpId = $_SESSION['RegId'] ?? null;

// Check if already paid
$alreadyPaid = false;
if ($mentorId && $entpId) {
    $checkQuery = "SELECT * FROM subscription WHERE EntpId = '$entpId' AND MentorId = '$mentorId'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        $alreadyPaid = true;
    }
}

// Handle payment submission
if (!$alreadyPaid && isset($_POST['submit'])) {
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $dd = mysqli_real_escape_string($conn, $_POST['dd']);
    $mm = mysqli_real_escape_string($conn, $_POST['mm']);
    $yy = mysqli_real_escape_string($conn, $_POST['yy']);
    $cv = mysqli_real_escape_string($conn, $_POST['cv']);
    $amount = mysqli_real_escape_string($conn, $_POST['final_payment']);

    $query = "INSERT INTO subscription (EntpId, MentorId, card_number, DD, MM, YY, Cv, Amount)
              VALUES ('$entpId', '$mentorId', '$card_number', '$dd', '$mm', '$yy', '$cv', '$amount')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Payment Successful!'); window.location.href='Entrepreneur_view_all_mentor.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<style>
    .custom-box {
        margin-top: 160px;
        background-color: #D0E6E8;
        padding: 40px;
        border-radius: 10px;
    }
</style>

<div class="container text-center">
    <?php if ($alreadyPaid): ?>
        <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
            <div class="alert alert-info text-center">
                <h4>You have already made a payment to this mentor.</h4>
            </div>
        </div>
    <?php else: ?>
        <form action="" method="post">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 custom-box">
                    <!-- Card Number -->
                    <div class="mb-3">
                        <label for="card_number" class="float-start">Card Number</label>
                        <input type="text" name="card_number" id="card_number" class="form-control"
                            placeholder="Valid Card Number" required pattern="\d{16}" maxlength="16"
                            title="Card number must be 16 digits">
                    </div>

                    <!-- Expiry Date and CV -->
                    <div class="row g-3 mb-3">
                        <div class="col-3">
                            <label for="dd" class="form-label">DD</label>
                            <input type="text" name="dd" id="dd" class="form-control" placeholder="DD" required
                                pattern="\d{1,2}" maxlength="2" title="Day (1 or 2 digits)">
                        </div>
                        <div class="col-3">
                            <label for="mm" class="form-label">MM</label>
                            <input type="text" name="mm" id="mm" class="form-control" placeholder="MM" required
                                pattern="0[1-9]|1[0-2]" maxlength="2" title="Month must be between 01 and 12">
                        </div>
                        <div class="col-3">
                            <label for="yy" class="form-label">YY</label>
                            <input type="text" name="yy" id="yy" class="form-control" placeholder="YY" required
                                pattern="\d{2}" maxlength="2" title="Enter 2-digit year">
                        </div>
                        <div class="col-3">
                            <label for="cv" class="form-label">CV</label>
                            <input type="text" name="cv" id="cv" class="form-control" placeholder="CV Code" required
                                pattern="\d{3,4}" maxlength="4" title="CV code must be 3 or 4 digits">
                        </div>
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label class="float-start">Amount</label>
                        <input type="text" name="final_payment" id="final_payment" class="form-control"
                            value="<?= htmlspecialchars($amount) ?>" readonly>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Pay</button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include("Footer.php"); ?>

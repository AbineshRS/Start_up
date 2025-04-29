<?php
include('Entrepreneur_nav.php'); ?>
<div class="container text-center col-12 col-md-6 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">CREATE YOUR STARTUP</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Your Journey to Success <br> Starts Here</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                style="width: 40px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<form method="post">
    <?php


    if (isset($_SESSION['RegId'])) {
        // Retrieve session data and store it in a variable
        $regId = $_SESSION['RegId'];
    }
    include("connection.php");
    $successMessage = "";
    if (isset($_POST['submit'])) {
        // Insert pitch idea
        $companyName = $_POST['companyName'];
        $category = $_POST['category'];
        $audience = $_POST['audience'];
        $problem = $_POST['problem'];
        $secret = $_POST['Secret'];
        $defined = $_POST['Defined'];
        $MarketValue = $_POST['MarketValue'];
        $competitor_1 = $_POST['Competitor_1'];
        $competitor_2 = $_POST['Competitor_2'];
        $differentiator = $_POST['differentiator'];
        $current_state = $_POST['Current_state'];
        $the_ask = $_POST['The_ask'];
        $to_help = $_POST['To_help'];
        $offering = $_POST['offering'];
        $Status = 0;

        $pitch_insert = "INSERT INTO `startup_pitch` (
            `RegId`, `CompanyName`, `Category`, `Audience`, `Problem`, `SecretSauce`, `DefinedMarket`, 
            `MarketValue`, `Competitor1`, `Competitor2`, `Differentiator`, `CurrentState`, 
            `Ask`, `HelpPurpose`, `EquityOffering`,`Status`
        ) VALUES (
            '$regId', '$companyName', '$category', '$audience', '$problem', '$secret', '$defined', 
            '$MarketValue', '$competitor_1', '$competitor_2', '$differentiator', '$current_state', 
            '$the_ask', '$to_help', '$offering','$Status'
        )";


        if ($conn->query($pitch_insert) === TRUE) {
            $successMessage = "✅ Your startup idea has been successfully submitted!";
        } else {
            $successMessage = "❌ Error: " . $conn->error;
        }


    }
    ?>
    <?php if (!empty($successMessage)): ?>
        <div
            style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin: 20px auto; width: 50%; text-align: center;">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>


    <div class="container text-center">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">My Company Name</label>
                <input type="text" class="form-control bg-light" placeholder="Name of the company" name="companyName">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">Is developing</label>
                <select class="form-select bg-light" aria-label="Default select example" name="category">
                    <option selected>Categories</option>
                    <option value="Idea Stage">Idea Stage</option>
                    <option value="Early Growth">Early Growth</option>
                    <option value="Scaling">Scaling</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">To help</label>
                <input type="text" class="form-control bg-light" placeholder="A defined audience" name="audience">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">To solve</label>
                <input type="text" class="form-control bg-light" placeholder="Solve a problem" name="problem">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">With</label>
                <input type="text" class="form-control bg-light" placeholder="Secret sauce" name="Secret">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">We compete in the growing</label>
                <input type="text" class="form-control bg-light" placeholder="Defined market" name="Defined">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">Which last year was a</label>
                <input type="text" class="form-control bg-light" placeholder="Defined value" name="MarketValue">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">We are similar to competitor 1</label>
                <input type="text" class="form-control bg-light" placeholder="Competitor 1" name="Competitor_1">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">Competitor 2</label>
                <input type="text" class="form-control bg-light" placeholder="Competitor 2" name="Competitor_2">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">But we</label>
                <input type="text" class="form-control bg-light" placeholder="One key differentiator"
                    name="differentiator">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">Currently we have</label>
                <input type="text" class="form-control bg-light" placeholder="Current state of product/team"
                    name="Current_state">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">We are looking for</label>
                <input type="text" class="form-control bg-light" placeholder="The ask" name="The_ask">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">To help us</label>
                <input type="text" class="form-control bg-light" placeholder="What you would do with the ask"
                    name="To_help">
            </div>
            <div class="col-lg-4 col-12 mb-3">
                <label class="float-start">In exchange of</label>
                <input type="text" class="form-control bg-light" placeholder="Amount of equity offering"
                    name="offering">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Pitch My Idea</button>
            </div>
        </div>
    </div>
</form>
<?php
include('Footer.php'); ?>
<?php include("Investors_nav.php");

include("connection.php");

// Get the ID from the URL
if (isset($_GET['id'])) {
    $Id = $_GET['id'];

    // Optional: sanitize ID (especially if not using prepared statements)
    $Id = intval($Id); // converts to integer for safety

    $sql = "SELECT 
    lg.Investing_category,
    lg.Name,
    lg.Contactnumber,
    lg.Occupation,
    lg.Organization,
    lg.Description,
    lg.Nationality,
    lg.Address,
    lg.Profile,
    l.Email 
FROM 
    inventor_register lg 
INNER JOIN 
    login l 
ON 
    lg.Id = l.RegId 
WHERE 
    lg.Id = '$Id' and l.Usertype='INVENTOR'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // This will hold the data
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
    include("connection.php"); // ensure it's open

    if (isset($_POST['accept'])) {
        $status = 'active';
    } elseif (isset($_POST['reject'])) {
        $status = 'inactive';
    }

    if (isset($status)) {
        $email = $row['Email'];
        $updateSql = "UPDATE login SET status = '$status' WHERE Email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            // redirect to the same page to avoid form resubmission and reset design
            header("Location: {$_SERVER['PHP_SELF']}?id=$Id&status_updated=$status");
            exit;
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }

}
?>
<style>
    .box {
        width: 193;
        height: 540;
        top: 198px;
        left: 124px;

        background-color: #EEF9FF;
    }
</style>

<div class="container text-center mt-5">
    <div class="row gx-4 box p-5 justify-content-center">
        <div class="col-12 col-md-4 mb-3 d-flex flex-column align-items-left">
            <img src="../upload/<?php echo $row['Profile']; ?>" alt="" class="img-fluid">
            <p class="fs-3"><?php echo $row['Name']; ?></p>
        </div>
        <div class="col-12 col-md-5 mb-3 ms-5">
            <div class="row">
                <div class="col">
                    <p class="text-start text-primary">E-Mail</p>
                    <p class="text-start"><?php echo $row['Email']; ?></p>
                </div>

                <div class="col">
                    <p class="text-primary text-start">Organization</p>
                    <p class="text-start"><?php echo $row['Organization']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-primary text-start">Investing Category</p>
                    <p class="text-start"><?php echo $row['Investing_category']; ?></p>
                </div>
                <div class="col">
                    <p class="text-primary text-start">Description</p>
                    <p class="text-start"><?php echo $row['Description']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-primary text-start">Contact No</p>
                    <p class="text-start"><?php echo $row['Contactnumber']; ?></p>
                </div>
                <div class="col">
                    <p class="text-primary text-start">Occupation</p>
                    <p class="text-start"><?php echo $row['Occupation']; ?> </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-primary text-start">Address</p>
                    <p class="text-start"><?php echo $row['Address']; ?></p>
                </div>
                <div class="col">
                    <p class="text-primary text-start">Nationality</p>
                    <p class="text-start"><?php echo $row['Nationality']; ?></p>
                </div>
            </div>
           
        </div>
    </div>
</div>
<?php include("Footer.php")?>
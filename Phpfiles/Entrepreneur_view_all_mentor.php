<?php include('Entrepreneur_nav.php') ?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">TOP MENTORS</p>
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

<?php
include("connection.php");
$sql = "SELECT * from mentor_register";
$result = $conn->query($sql);

if ($result->num_rows > 0) { ?>
    <div class="container text-center mt-5">
        <div class="row mb-5">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-3 mb-3 d-flex">
                    <div class="card flex-fill">
                        <a href="Entrepreneur_view_details_mentor.php?id=<?php echo $row['id']; ?>">
                            <img src="../upload/<?php echo $row['Profile']; ?>" class="card-img-top" alt="Investor Image"
                                style="object-fit: stretch; height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo $row['Name']; ?></h5>
                                <p class="card-text">MENTOR</p>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
<?php } else {
    echo "<h4>No investors found</h4>";
}
?>

<?php include('Footer.php') ?>
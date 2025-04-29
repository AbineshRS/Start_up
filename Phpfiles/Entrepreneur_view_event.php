<style>
    .cont {
        min-height: 600px;
    }
</style>
<?php include("Entrepreneur_nav.php") ?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View Events</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder"></p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                style="width: 40px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 p-3 cont">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT * from events order by id desc";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;"></th>
                        <th style="min-width: 200px;">Event Name</th>
                        <th style="min-width: 150px;">Date</th>
                        <th style="min-width: 150px;">location</th>
                        <th style="min-width: 120px;">Category</th>
                        <th style="min-width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th>
                                <div class="d-flex align-items-center flex-wrap">
                                    <img src="<?php echo $row['file']; ?>" alt="Profile" class="img-fluid rounded-circle">
                                </div>
                            </th>
                            <td class="text-break"><?php echo $row['eventname']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="Entrepreneur_view_detailed_event.php?id=<?php echo $row['Id']; ?>"
                                        class="d-flex align-items-center text-decoration-none">
                                        <img src="../assets/carbon_view-filled.png" alt="View Icon" class="img-fluid"
                                            style="height: 16px;">
                                        <span class="ms-2">View Details</span>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        <?php $i++;
                    } ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>No events found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<?php include('Footer.php') ?>
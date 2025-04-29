<?php include("Investors_nav.php")?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View All</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Investors</p>
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
<div class="container mt-3 p-3 cont">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT rg.Id, rg.Profile, rg.Name, rg.Investing_category, lg.Email, rg.Contactnumber, rg.Nationality 
        FROM inventor_register rg 
        INNER JOIN login lg ON rg.id = lg.RegId where lg.Usertype='INVENTOR'ORDER BY rg.Id DESC LIMIT 5";
        ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 200px;">E-Mail ID</th>
                        <th style="min-width: 150px;">Investing Category</th>
                        <th style="min-width: 150px;">Contact No</th>
                        <th style="min-width: 120px;">Nationality</th>
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
                                    <img src="../upload/<?php echo $row['Profile']; ?>" alt="Profile"
                                        class="img-fluid rounded-circle" style="height: 40px; width: 40px;">
                                    <span class="ms-2 text-truncate" style="max-width: 100px;">
                                        <?php
                                        $first = isset($row['Name']) ? $row['Name'] : '';
                                        echo $first
                                            ?>
                                    </span>
                                </div>
                            </th>
                            <td class="text-break"><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Investing_category']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td><?php echo $row['Nationality']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="Investor_view_detail_pages.php?id=<?php echo $row['Id']; ?>"
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
<?php include("Footer.php")?>
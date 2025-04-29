<?php include("mentor_nav.php") ?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View All</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Blog</p>
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

<div class="container mt-3 p-3">
    <div class="table-responsive">
        <?php
        $Id = $_SESSION['RegId'];
        include("connection.php");
        // Fetch blogs where the Status is 0 (approved) or Status is 1 (pending/rejected)
        $sql = "SELECT * FROM blog WHERE Pid=$Id ORDER BY Id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 50px;">S.No</th> <!-- Added Serial Number header -->
                        <th style="min-width: 150px;">Title</th>
                        <th style="min-width: 200px;">E-Mail ID</th>
                        <th style="min-width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td> <!-- Display Serial Number -->
                            <td class="text-break"><?php echo $row['Title']; ?></td>
                            <td>
                                <?php
                              
                                    echo $row['Description'];  // Show description if Status is 0 (approved)
                                
                                ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php
                                    // Only show "View Details" if Status is 0 (approved)
                                    if ($row['Status'] == 0) {
                                    ?>
                                        <a href="mentor_update_bolg.php?id=<?php echo $row['Id']; ?>"
                                            class="d-flex align-items-center text-decoration-none">
                                            <img src="../assets/carbon_view-filled.png" alt="View Icon" class="img-fluid"
                                                style="height: 16px;">
                                            <span class="ms-2">View Details</span>
                                        </a>
                                    <?php
                                    } else {
                                        // Optionally, show a message or leave the cell empty if Status is 1
                                        echo "<span>Please contact admin</span>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>No blogs found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<?php include('Footer.php') ?>

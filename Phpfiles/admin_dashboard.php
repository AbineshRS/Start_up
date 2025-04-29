<?php include('admin_nav.php');
include("connection.php");
$sql = "SELECT COUNT(*) AS enterp_count FROM register rg INNER JOIN login lg ON rg.id = lg.RegId WHERE lg.Usertype = 'ENTREPRENEUR' ";
$result = $conn->query($sql);
// Declare and initialize count variable
$enterp = 0;

if ($result && $row = $result->fetch_assoc()) {
    $enterp = $row['enterp_count']; // Store in variable
}
//Inventor
$sql1 = "SELECT COUNT(*) AS investor_count FROM inventor_register rg INNER JOIN login lg ON rg.id = lg.RegId WHERE lg.Usertype = 'INVENTOR'";
$result1 = $conn->query($sql1);
$investorCount = 0;

if ($result1 && $row = $result1->fetch_assoc()) {
    $investorCount = $row['investor_count']; // Store in variable
}

//Mentors
$sql2 = "SELECT COUNT(*) AS mentor_count FROM mentor_register rg INNER JOIN login lg ON rg.id = lg.RegId WHERE lg.Usertype = 'MENTOR'";
$result2 = $conn->query($sql2);
$mentor = 0;

if ($result2 && $row = $result2->fetch_assoc()) {
    $mentor = $row['mentor_count']; // Store in variable
}

//Events
$sql3 = "SELECT COUNT(*) AS events FROM events" ;
$result3 = $conn->query($sql3);
$event = 0;

if ($result3 && $row = $result3->fetch_assoc()) {
    $event = $row['events']; 
}
?>
<style>
    .box {
        width: 284;
        height: 168;
        top: 13px;
        border-width: 0.5px;
        background-color: #EEF9FF;
    }

    .tbh {
        background-color: #D3DDE1;
    }
</style>
<div class="container mt-5 p-3">
    <div class="row">
        <div class="col-5 text-start">
            <p class="pt-5 text-primary">Overview</p>
            <p>Admin Dashboard</p>
        </div>
    </div>
</div>

<div class="container text-center">
    <!-- gx-4 for column spacing, gy-4 for row spacing on smaller screens -->
    <div class="row gx-4 gy-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="box p-4 bg-light h-100">
                <p class="text-start fs-5">Investors</p>
                <div class="row align-items-center">
                    <div class="col mt-2">
                        <h3><?php echo $investorCount ?></h3>
                    </div>
                    <div class="col">
                        <img src="../assets/hugeicons_alms.png" alt="" class="img-fluid" style="max-width: 50px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="box p-4 bg-light h-100">
                <p class="text-start fs-5">Mentors</p>
                <div class="row align-items-center">
                    <div class="col mt-2">
                    <h3><?php echo $mentor ?></h3>
                    </div>
                    <div class="col">
                        <img src="../assets/hugeicons_mentoring.png" alt="" class="img-fluid" style="max-width: 50px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="box p-4 bg-light h-100">
                <p class="text-start fs-5">Entrepreneurs</p>
                <div class="row align-items-center">
                    <div class="col mt-2">
                    <h3><?php echo $enterp ?></h3>
                    </div>
                    <div class="col">
                        <img src="../assets/Group 56.png" alt="" class="img-fluid" style="max-width: 50px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="box p-4 bg-light h-100">
                <p class="text-start fs-5">Events</p>
                <div class="row align-items-center">
                    <div class="col mt-2">
                        <h3><?php echo $event ?></h3>
                    </div>
                    <div class="col">
                        <img src="../assets/Vector (11).png" alt="" class="img-fluid" style="max-width: 50px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 p-3">
    <div class="row">
        <div class="col-5 text-start">
            <p class="pt-5 text-primary">View</p>
            <p>Recent Investors</p>
        </div>
    </div>
</div>
<div class="container mt-3 p-3">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT rg.Id, rg.Profile, rg.Name, rg.Investing_category, lg.Email, rg.Contactnumber, rg.Nationality 
        FROM inventor_register rg 
        INNER JOIN login lg ON rg.id = lg.RegId where lg.Usertype='INVENTOR'ORDER BY rg.Id DESC LIMIT 5";
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
                                    <a href="Investors_view_detail_page.php?id=<?php echo $row['Id']; ?>" class="d-flex align-items-center text-decoration-none">
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
        <div class="d-flex align-items-center justify-content-end">
            <a class="mb-0 me-2" href="admin_view_all_investors.php">View All
                <img src="../assets/Vector (22).png" alt="View Icon" class="img-fluid" style="height: 10px;"></a>
        </div>
    </div>
</div>
<div class="container  p-3">
    <div class="row">
        <div class="col-5 text-start">
            <p class="pt-5 text-primary">View</p>
            <p>Recent Mentors</p>
        </div>
    </div>
</div>
<div class="container mt-3 p-3">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT rg.Id, rg.Profile, rg.Name, rg.Expertise_area, lg.Email, rg.contact, rg.Description 
        FROM mentor_register rg 
        INNER JOIN login lg ON rg.id = lg.RegId where lg.Usertype='MENTOR' ORDER BY rg.Id DESC LIMIT 5";
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
                            <td><?php echo $row['Expertise_area']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="mentor_view_detail_page.php?id=<?php echo $row['Id']; ?>" class="d-flex align-items-center text-decoration-none">
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
        <div class="d-flex align-items-center justify-content-end">
            <a class="mb-0 me-2" href="admin_view_all_mentors.php">View All
                <img src="../assets/Vector (22).png" alt="View Icon" class="img-fluid" style="height: 10px;"></a>
        </div>
    </div>
</div>


<?php include('admin_footer.php') ?>
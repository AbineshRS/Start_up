<?php include("Entrepreneur_nav.php") ?>
<style>
    .hh {
        margin-top: 110px;
    }
</style>
<div class="container text-center hh">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">My subscription</p>
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
<div class="container mt-3 p-3 cont">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $id = $_SESSION['RegId'];
        $sql = "SELECT 
    rg.Name, 
    rg.Contactnumber,ri.Status,rg.Nationality,rg.Address,rg.Profile,ri.Id
FROM 
    inventor_register rg 
INNER JOIN 
    requestinvestor ri 
ON 
    rg.id = ri.InvestorsId 
WHERE 
    ri.EntrepreneurId = $id ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 200px;">Contact No</th>
                        <th style="min-width: 150px;">Nationality</th>
                        <th style="min-width: 150px;">Address</th>
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
                            <td><?php echo $row['Nationality']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="chat2.php?requestid=<?php echo $row['Id']; ?>"
                                        class="d-flex align-items-center text-decoration-none">
                                        <i class="bi bi-chat-dots-fill" style="font-size: 16px;"></i>
                                        <span class="ms-2">Chat Now</span>
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
            echo "<h4 class='text-center'>Not found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<?php include("Footer.php") ?>
<?php
include("Investors_nav.php");
?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View All</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder">Chats</p>
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
        $id = $_SESSION['RegId'];

        // Fetch chat users related to this investor, considering the Status field
        $sql = "SELECT rg.FirstName, rg.CompanyName, rg.Profile, rg.Contactnumber, rg.Id as rid, ri.Id as RequestId, ri.Status, sp.PitchId
                FROM register rg
                INNER JOIN requestinvestor ri ON rg.id = ri.EntrepreneurId
                INNER JOIN startup_pitch sp ON sp.RegId=rg.Id
                WHERE ri.InvestorsId = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 200px;">Company Name</th>
                        <th style="min-width: 120px;">Contact</th>
                        <th style="min-width: 150px;">Action</th>
                        <th style="min-width: 150px;">Chat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $canChat = ($row['Status'] == 0); // Check if Status is 0 (can chat)
                        ?>
                        <tr>
                            <th>
                                <div class="d-flex align-items-center flex-wrap">
                                    <img src="../upload/<?php echo $row['Profile']; ?>" alt="Profile"
                                        class="img-fluid rounded-circle" style="height: 40px; width: 40px;">
                                    <span class="ms-2 text-truncate" style="max-width: 100px;">
                                        <?php echo isset($row['FirstName']) ? $row['FirstName'] : ''; ?>
                                    </span>
                                </div>
                            </th>
                            <td class="text-break"><?php echo $row['CompanyName']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="Investor_view_plane.php?pitchid=<?php echo $row['PitchId']; ?>&requestid=<?php echo $row['RequestId']; ?>"
                                        class="d-flex align-items-center text-decoration-none">
                                        <img src="../assets/carbon_view-filled.png" alt="View Icon" class="img-fluid"
                                            style="height: 16px;">
                                        <span class="ms-2">View Details</span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if (!$canChat) { ?> <!-- If Status is 1, allow chat (opposite logic) -->
                                        <!-- If Status is 1, allow chat -->
                                        <a href="chat_page.php?requestid=<?php echo $row['rid']; ?>"
                                            class="d-flex align-items-center text-decoration-none">
                                            <!-- Using Bootstrap Icon for chat -->
                                            <i class="bi bi-chat" style="font-size: 16px;"></i>
                                            <span class="ms-2">Chat Now</span>
                                        </a>
                                    <?php } else { ?>
                                        <!-- If Status is 0, display 'Cannot Chat' -->
                                        <span class="ms-2 text-muted">Cannot Chat</span>
                                    <?php } ?>
                                </div>


                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4 class='mt-5 text-center'>Accept it</h4>";
        }
        ?>
    </div>
</div>

<?php include("Footer.php") ?>
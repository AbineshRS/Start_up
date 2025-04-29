<?php
include("mentor_nav.php");
include("connection.php");
?>

<div class="container text-center mt-5">
    <div class="row mt-5">
        <div class="col mt-5">
            <p class="text-primary fs-5">Entrepreneur Subscription List</p>
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

<div class="container mt-3 p-3">
    <div class="table-responsive">
        <?php
        if (isset($_SESSION['RegId'])) {
            $Id = $_SESSION['RegId'];

            // ✅ Always use prepared statements for security
            $stmt = $conn->prepare("SELECT distinct mr.Id, mr.FirstName, mr.Contactnumber, mr.Address
FROM register mr
INNER JOIN subscription sb ON sb.EntpId = mr.id
WHERE sb.MentorId = ?");
            $stmt->bind_param("i", $Id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                ?>
                <table class="table align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th style="min-width: 50px;">S.No</th>
                            <th style="min-width: 150px;">Name</th>
                            <th style="min-width: 200px;">Contactnumber</th>
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
                                <td><?php echo $i; ?></td>
                                <td class="text-break"><?php echo ($row['FirstName']); ?></td>
                                <td class="text-break"><?php echo ($row['Contactnumber']); ?></td>
                                <td class="text-break"><?php echo ($row['Address']); ?></td>
                                <td>
                                    <a href="chat_page3.php?requestid=<?php echo $row['Id']; ?>"
                                        class="text-decoration-none d-flex align-items-center">
                                        <!-- Bootstrap Chat Icon -->
                                        <i class="bi bi-chat" style="font-size: 16px;"></i>
                                        <span class="ms-2">Chat Now</span>
                                    </a>


                                </td>
                            </tr>
                            <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<h4 class='text-center'>No subscriptions found</h4>";
            }
            $stmt->close();
        } else {
            echo "<h4 class='text-center text-danger'>Session expired or user not logged in.</h4>";
        }
        ?>
    </div>
</div>

<?php include("Footer.php"); ?>
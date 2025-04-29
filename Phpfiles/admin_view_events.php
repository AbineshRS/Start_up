<?php include('admin_nav.php');
include("connection.php"); ?>
<style>
    .cont {
        min-height: 500px;
    }
</style>
<div class="container  p-3 ">
    <div class="row">
        <div class="col-5 text-start">
            <p class="pt-5 text-primary">View</p>
            <p>Entrepreneur</p>
        </div>
    </div>
</div>
<div class="container  p-3 cont">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT ev.eventname, ev.date,mr.FirstName,ev.file,mr.Contactnumber,mr.Address
                FROM events ev
                INNER JOIN event_reg er ON er.Eventid = ev.Id
                INNER join register mr on mr.id=er.EenterId;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Event Name</th>
                        <th style="min-width: 200px;">Event date</th>
                        <th style="min-width: 150px;">Entrepreneur Name</th>
                        <th style="min-width: 150px;">Entrepreneur Contact No</th>
                        <th style="min-width: 120px;">Entrepreneur Address</th>
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
                                    <img src="../upload/<?php echo $row['file']; ?>" alt="file" class="img-fluid rounded-circle"
                                        style="height: 40px; width: 40px;">
                                    <span class="ms-2 text-truncate" style="max-width: 100px;">
                                        <?php
                                        $first = isset($row['eventname']) ? $row['eventname'] : '';
                                        echo $first
                                            ?>
                                    </span>
                                </div>
                            </th>
                            <td class="text-break"><?php echo $row['date']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
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

<?php include('admin_footer.php') ?>
<style>
    .cont {
        min-height: 300px;
    }
</style>
<?php include("admin_nav.php") ?>
<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">View Complaints</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder"> Enterpurner Complaints </p>
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
        $sql = "SELECT cm.title,cm.title,cm.description,cm.photo,rg.FirstName,rg.Contactnumber from complaints cm
                 INNER join register rg on rg.id=cm.Pid where usertype='ENTREPRENEUR'";
        ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Title</th>
                        <th style="min-width: 200px;">Description</th>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 150px;">Contact No</th>
                        <th style="min-width: 150px;">Proof</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>

                            <td class="text-break"><?php echo $row['title']; ?></td>
                            <td class="text-break"><?php echo $row['description']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td>
                                <a href="../upload/<?php echo $row['photo']; ?>" target="_blank" class="btn btn-primary">View
                                    Proof</a>
                            </td>

                        </tr>
                        <?php $i++;
                    } ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>Not found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<div class="container text-center col-12 col-md-3">
    <div class="row">
        <div class="col">
            <p class="fw-bolder"> Mentor Complaints </p>
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
<div class="container  p-3 mb-5">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT cm.title,cm.title,cm.description,cm.photo,rg.FirstName,rg.Contactnumber from complaints cm
                 INNER join register rg on rg.id=cm.Pid where usertype='MENTOR'";
        ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Title</th>
                        <th style="min-width: 200px;">Description</th>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 150px;">Contact No</th>
                        <th style="min-width: 150px;">Proof</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>

                            <td class="text-break"><?php echo $row['title']; ?></td>
                            <td class="text-break"><?php echo $row['description']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td>
                                <a href="../upload/<?php echo $row['photo']; ?>" target="_blank" class="btn btn-primary">View
                                    Proof</a>
                            </td>

                        </tr>
                        <?php $i++;
                    } ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>Not found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<div class="container text-center col-12 col-md-3 mb-5">
    <div class="row">
        <div class="col">
            <p class="fw-bolder"> Investor Complaints </p>
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
<div class="container  p-3 ">
    <div class="table-responsive">
        <?php
        include("connection.php");
        $sql = "SELECT cm.title,cm.title,cm.description,cm.photo,rg.Name,rg.Contactnumber from complaints cm
                 INNER join inventor_register rg on rg.id=cm.Pid where usertype='INVENTOR';";
        ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            ?>
            <table class="table align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width: 150px;">Title</th>
                        <th style="min-width: 200px;">Description</th>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 150px;">Contact No</th>
                        <th style="min-width: 150px;">Proof</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>

                            <td class="text-break"><?php echo $row['title']; ?></td>
                            <td class="text-break"><?php echo $row['description']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Contactnumber']; ?></td>
                            <td>
                                <a href="../upload/<?php echo $row['photo']; ?>" target="_blank" class="btn btn-primary">View
                                    Proof</a>
                            </td>

                        </tr>
                        <?php $i++;
                    } ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h4>Not found</h4>"; // Update colspan to 7
        }
        ?>
    </div>
</div>
<?php include('admin_footer.php') ?>
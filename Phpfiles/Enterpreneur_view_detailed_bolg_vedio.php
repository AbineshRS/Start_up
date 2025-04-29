<?php include("Entrepreneur_nav.php"); ?>
<?php include("connection.php"); ?>

<div class="container text-center mt-5">
    <div class="row mt-5">
        <div class="col">
            <p class="text-primary fs-5">Tutorial</p>
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
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch Blog data
    $blogQuery = "SELECT * FROM blog WHERE Pid = ? and Status=0 ORDER BY id DESC";
    $stmt1 = $conn->prepare($blogQuery);
    $stmt1->bind_param("s", $id);
    $stmt1->execute();
    $blogResult = $stmt1->get_result();

    // Fetch Tutorial data
    $tutorialQuery = "SELECT * FROM tutorail WHERE Pid = ? ORDER BY Id DESC";
    $stmt2 = $conn->prepare($tutorialQuery);
    $stmt2->bind_param("s", $id);
    $stmt2->execute();
    $tutorialResult = $stmt2->get_result();
    ?>

    <div class="container mt-4">
        <!-- Blog Section -->
        <div class="row">
            <div class="col">
                <h4 class="text-center text-primary mb-4">Blogs</h4>
            </div>
        </div>

        <div class="row">
            <?php if ($blogResult->num_rows > 0): ?>
                <?php while ($row = $blogResult->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="../upload/<?= htmlspecialchars($row['File']) ?>" class="card-img-top" alt="Blog Image" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['Title']) ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($row['Description'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-muted text-center">No blog entries found.</p>
            <?php endif; ?>
        </div>

        <!-- Tutorial Section -->
        <div class="row mt-5">
            <div class="col">
                <h4 class="text-center text-primary mb-4">Tutorials</h4>
            </div>
        </div>

        <div class="row">
            <?php if ($tutorialResult->num_rows > 0): ?>
                <?php while ($row = $tutorialResult->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['Title']) ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($row['Description'])) ?></p>
                                <?php if (!empty($row['File'])): ?>
                                    <div class="ratio ratio-16x9 mt-3">
                                        <video controls>
                                            <source src="../upload/<?= htmlspecialchars($row['File']) ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-muted text-center">No tutorials found.</p>
            <?php endif; ?>
        </div>
    </div>

<?php
} else {
    echo "<div class='container text-center mt-5'><p class='text-danger'>No ID provided.</p></div>";
}
?>

<?php include("Footer.php"); ?>

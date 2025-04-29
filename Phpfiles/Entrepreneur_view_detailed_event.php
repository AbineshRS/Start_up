<?php 
include('Entrepreneur_nav.php');
include("connection.php");

// Check if session variable 'RegId' is set (the entrepreneur must be logged in)


// Get Event ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // secure integer conversion

    // Fetch the event details
    $sql = "SELECT * FROM events WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Event not found.";
        exit;
    }
} else {
    echo "No event selected.";
    exit;
}

// Check if the entrepreneur is already registered for this event
$alreadyRegistered = false;
$entrepreneurId = $_SESSION['RegId'];
$checkRegistrationSql = "SELECT * FROM event_reg WHERE EenterId = ? AND Eventid = ?";
$stmtCheck = $conn->prepare($checkRegistrationSql);
$stmtCheck->bind_param("ii", $entrepreneurId, $id);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    $alreadyRegistered = true;
}

// Register the entrepreneur for the event if they haven't registered yet
if (isset($_POST['register']) && !$alreadyRegistered) {
    $registerSql = "INSERT INTO event_reg (EenterId, Eventid) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($registerSql);
    $stmtInsert->bind_param("ii", $entrepreneurId, $id);

    if ($stmtInsert->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='Entrepreneur_view_event.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to register. Please try again.');</script>";
    }
}
?>

<div class="container mt-5 col-6">
    <!-- Event Main Heading -->
    <h2 class="text-primary text-center mb-5"><?php echo htmlspecialchars($row['eventname']); ?></h2>

    <!-- Event Details Section -->
    <div class="card shadow-sm p-4">
        <div class="row">
            <!-- First Column -->
            <div class="col-md-6">
                <p><strong>Date:</strong> <br><?php echo htmlspecialchars($row['date']); ?></p>
                <p><strong>Title:</strong> <br><?php echo htmlspecialchars($row['title']); ?></p>
                <p><strong>Description:</strong> <br><?php echo htmlspecialchars($row['description']); ?></p>
            </div>

            <!-- Second Column -->
            <div class="col-md-6">
                <p><strong>Location:</strong> <br><?php echo htmlspecialchars($row['location']); ?></p>
                <p><strong>Category:</strong> <br><?php echo htmlspecialchars($row['category']); ?></p>

                <?php if (!empty($row['file'])): ?>
                    <div class="mt-3">
                        <img src="<?php echo htmlspecialchars($row['file']); ?>" alt="Event Photo" class="img-fluid rounded">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Register Button -->
        <div class="text-center mt-4">
            <?php if ($alreadyRegistered): ?>
                <p class="text-success">You have already registered for this event!</p>
            <?php else: ?>
                <button type="button" class="btn btn-success px-5" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Event Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <p>Are you sure you want to register for <strong><?php echo htmlspecialchars($row['eventname']); ?></strong>?</p>
            </div>

            <div class="modal-footer">
                <form action="" method="post">
                    <button type="submit" class="btn btn-success" name="register">Yes, Register</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include("Footer.php"); ?>

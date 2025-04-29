<?php include("Investors_nav.php"); ?>
<?php
include("connection.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user details
    $sql = "SELECT rg.Name, rg.Profile FROM inventor_register rg WHERE rg.Id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<h4>User not found</h4>";
        exit;
    }
} else {
    echo "<h4>No user selected</h4>";
    exit;
}

// Assuming current logged-in user id
$currentUserId = 1; // You can replace this with your session user id if needed

// Handle sending message
if (isset($_POST['send']) && !empty($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = "INSERT INTO chat_messages (sender_id, receiver_id, message)
               VALUES ('$currentUserId', '$userId', '$message')";
    $conn->query($insert);
}
?>

<div class="container text-center col-12 col-md-3 mt-5">
    <div class="row">
        <div class="col">
            <p class="fs-5 fw-semibold text-primary">Chat With</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="fw-bolder"><?php echo htmlspecialchars($user['Name']); ?></p>
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
    <div class="card">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <img src="../upload/<?php echo htmlspecialchars($user['Profile']); ?>" alt="Profile"
                class="rounded-circle me-2" style="width: 40px; height: 40px;">
            <span><?php echo htmlspecialchars($user['Name']); ?></span>
        </div>
        <div class="card-body" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
            <?php
            // Fetch chat messages
            $chat_sql = "SELECT * FROM chat_messages 
                         WHERE (sender_id = $currentUserId AND receiver_id = $userId)
                            OR (sender_id = $userId AND receiver_id = $currentUserId)
                         ORDER BY sent_at ASC";
            $chat_result = $conn->query($chat_sql);

            if ($chat_result->num_rows > 0) {
                while ($chat = $chat_result->fetch_assoc()) {
                    if ($chat['sender_id'] == $currentUserId) {
                        // Sent message
                        echo '<div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white p-2 rounded-end" style="max-width: 75%;">
                                    <p class="mb-0 text-end">' . htmlspecialchars($chat['message']) . '</p>
                                </div>
                              </div>';
                    } else {
                        // Received message
                        echo '<div class="d-flex mb-3">
                                <div class="bg-light p-2 rounded-start" style="max-width: 75%;">
                                    <p class="mb-0 text-start">' . htmlspecialchars($chat['message']) . '</p>
                                </div>
                              </div>';
                    }
                }
            } else {
                echo "<p class='text-center text-muted'>No messages yet. Start the conversation!</p>";
            }
            ?>
        </div>
        <div class="card-footer">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your message..." name="message" required>
                    <button class="btn btn-primary" type="submit" name="send">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

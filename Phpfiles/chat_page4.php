<?php 
include("Entrepreneur_nav.php");
include("connection.php");

$id = $_SESSION['RegId']; // Logged-in user ID
$currentUser = $_SESSION['usertype']; // Logged-in user type (Investor)

// Handle sending message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = htmlspecialchars(trim($_POST['message']));
    $request_id = $_GET['requestid']; // From URL
    $created_at = date('Y-m-d H:i:s'); // Current time

    if (!empty($message)) {
        $sender_name = $_SESSION['usertype']; // Investor or Entrepreneur
        $user_id = $_SESSION['RegId']; // User ID

        $sql = "INSERT INTO chat (request_id, sender_name, message, created_at, investid) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $request_id, $sender_name, $message, $created_at, $user_id);
        $stmt->execute();
    }
}

$Id = $_SESSION['RegId'];
$Id2 = $_GET['requestid'];

// Fetch messages
$sql = "SELECT * FROM chat WHERE request_id = ? AND investid = ? ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $Id2, $Id);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin-top: 0;
}

.cont {
    margin-top: 100px;
}

.chat-box {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    max-height: 400px;
}

.message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    position: relative;
}

/* Dynamic classes */
.message-left {
    background-color: #d4edda; /* Green for receiver */
    margin-right: auto;
    text-align: left;
    max-width: 80%;
}

.message-right {
    background-color: #d1e7f3; /* Blue for sender */
    margin-left: auto;
    text-align: right;
    max-width: 80%;
}

.sender {
    font-weight: bold;
    font-size: 1.1em;
}

.text {
    font-size: 1em;
    margin-top: 5px;
}

.time {
    font-size: 0.8em;
    color: #999;
    text-align: right;
    position: absolute;
    bottom: 5px;
    right: 10px;
}

.form-container {
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-container textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
    font-size: 1em;
}

.form-container button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #0056b3;
}

.no-messages {
    text-align: center;
    color: #aaa;
    font-size: 1.2em;
}
</style>

<div class="container cont">
    <h2 class="text-center mt-5">Chat with Entrepreneur</h2>
    <div class="chat-box" id="chatBox">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $isCurrentUser = ($row['sender_name'] == $currentUser); // Checking if it's your message
                $messageClass = $isCurrentUser ? 'message-right' : 'message-left';
        ?>
                <div class="message <?php echo $messageClass; ?>">
                    <div class="sender">
                        <?php echo htmlspecialchars($row['sender_name']); ?>
                    </div>
                    <div class="text mt-2 mb-2"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                    <div class="time"><?php echo date('d M Y h:i A', strtotime($row['created_at'])); ?></div>
                </div>
        <?php
            }
        } else {
            echo "<div class='no-messages'>No messages yet.</div>";
        }
        ?>
    </div>

    <!-- Send Message Form -->
    <div class="form-container mt-3">
        <form method="POST">
            <textarea name="message" rows="3" placeholder="Type your message..." required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Send</button>
        </form>
    </div>
</div>

<?php include("Footer.php"); ?>

<script>
// Auto scroll to latest message
window.onload = function() {
    var chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
};
</script>

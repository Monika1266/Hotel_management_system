<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "booking";

$conn = new mysqli($host, $user, $password, $db);

// Define variables to store messages
$successMessage = "";
$errorMessage = "";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomNumber = $_POST["roomNumber"];

    // Check if the room number exists in the bookings table
    $checkRoomQuery = "SELECT id FROM bookings WHERE room_id = '$roomNumber'";
    $result = $conn->query($checkRoomQuery);

    if ($result->num_rows > 0) {
        // Room number found, remove the booking
        $deleteBookingQuery = "DELETE FROM bookings WHERE room_id = '$roomNumber'";
        if ($conn->query($deleteBookingQuery) === TRUE) {
            // Update room status to 'available'
            $updateRoomStatusQuery = "UPDATE rooms SET status='available' WHERE id='$roomNumber'";
            if ($conn->query($updateRoomStatusQuery) === TRUE) {
                // Booking removed successfully and room status updated
                $successMessage = "Booking for Room Number $roomNumber has been removed and room status set to available.";
            } else {
                // Error in updating room status
                $errorMessage = "Error updating room status: " . $conn->error;
            }
        } else {
            // Error in removing booking
            $errorMessage = "Error removing booking: " . $conn->error;
        }
    } else {
        // Room number not found in bookings table
        $errorMessage = "No booking found for Room Number $roomNumber.";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Booking</title>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('images/room3.png') no-repeat center center/cover;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-top: 50px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.remove-btn {
    display: inline-block;
    width: 120px;
    height: 40px;
    background-color: #ff5555;
    color: white;
    text-align: center;
    line-height: 40px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.remove-btn:hover {
    background-color: #ff3333;
}

.msg1{
    background-color: #4caf50; 
    color: white; 
    padding: 10px; 
    margin: 10px 0;
}
.msg2{
    background-color: #ff5555; 
    color: white; 
    padding: 10px; 
    margin: 10px 0;
}
.logout-btn {
    display: inline-block;
    padding: 10px 20px;
    background: #27ae60;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #555;
}
</style>
</head>

<body>
    <div class="container">
    <div style="position: absolute; top: 10px; right: 10px;">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

        <h1>Remove Booking</h1>
        <form action="#" method="post">
            <label for="roomNumber">Room Number:</label>
            <input type="text" id="roomNumber" name="roomNumber" required>
            <button type="submit" class="remove-btn">Remove</button>
        </form>

        <?php if (!empty($successMessage)) { ?>
            <div class="msg1">
                <?php echo $successMessage; ?>
            </div>
        <?php } ?>

        <?php if (!empty($errorMessage)) { ?>
            <div class="msg2">
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>


<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "booking";

session_start();

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $checkIn = $_POST["check-in"];
    $checkOut = $_POST["check-out"];
    $guests = $_POST["guests"];
    $days = $_POST["days"];
    $roomType = $_POST["room"];
    $paymentMode = $_POST["payment"];

    $availableRoomQuery = "SELECT id FROM rooms WHERE status='available' LIMIT 1";
    $result = $conn->query($availableRoomQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $roomId = $row["id"];

        $updateRoomStatusQuery = "UPDATE rooms SET status='booked' WHERE id=$roomId";
        $conn->query($updateRoomStatusQuery);

        $insertBookingQuery = "INSERT INTO bookings (room_id, name, phone, address, check_in, check_out, guests, days, room_type, payment_mode) 
                               VALUES ('$roomId', '$name', '$phone', '$address', '$checkIn', '$checkOut', '$guests', '$days', '$roomType', '$paymentMode')";

        if ($conn->query($insertBookingQuery) === TRUE) {
            
            $redirectUrl = "confirm.php?roomId=$roomId&checkInDate=$checkIn&checkOutDate=$checkOut&guests=$guests&days=$days&roomType=$roomType&paymentMode=$paymentMode";
            
           
            header("Location: $redirectUrl");
            exit();
        } else {
            echo "<script>alert('Error: " . $insertBookingQuery . "\\n" . $conn->error . "');</script>";
        }

    } else {
        $message= "Sorry, no available rooms at the moment. Please try again later.";
        echo "<script>alert('$message');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/room.png') no-repeat center center/cover;
        }

        .booking-form-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
        }

        .booking-form {
            width: 300px;
            text-align: center;
            color: white;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label,
        input,
        textarea,
        select {
            width: 100%;
            display: block;
            margin-bottom: 5px;
            padding: 1px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
        .buttons {
    position: absolute; 
    top: 10px; 
    right: 10px; 
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #27ae60;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    font-weight: bold;
}
    </style>
</head>

<body>
    <div class="booking-form-container">
        <div class="booking-form">
            <h2>Book a Room</h2>
            <form action="#" method="POST">
            <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>

                <div class="form-group">
                    <label for="check-in">Check-in Date:</label>
                    <input type="date" id="check-in" name="check-in" required>
                </div>

                <div class="form-group">
                    <label for="check-out">Check-out Date:</label>
                    <input type="date" id="check-out" name="check-out" required>
                </div>

                <div class="form-group">
                    <label for="guests">Number of Guests:</label>
                    <input type="number" id="guests" name="guests" required>
                </div>

                <div class="form-group">
                    <label for="days">Number of days:</label>
                    <input type="number" id="days" name="days" required>
                </div>

                <div class="form-group">
                    <label for="room">Select room type:</label>
                    <select id="room" name="room" required>
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="premium">Premium</option>
                        <option value="superior">Superior</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment">Payment Mode:</label>
                    <select id="payment" name="payment" required>
                        <option value="credit">Credit Card</option>
                        <option value="debit">Debit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
</body>

</html>

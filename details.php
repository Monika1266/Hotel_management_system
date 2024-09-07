<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('images/room1.jpg') no-repeat center center/cover;
        }

        .container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 25px;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "booking";

        $conn = new mysqli($host, $user, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["roomId"])) {
            $roomId = $_GET["roomId"];

            $sql = "SELECT * FROM bookings WHERE room_id = $roomId";
            $result = $conn->query($sql);

            echo "<h1>Booking Details</h1>";

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>User Name: " . $row["name"] . "</p>";
                echo "<p>Phone: " . $row["phone"] . "</p>";
                echo "<p>Address: " . $row["address"] . "</p>";
                echo "<p>Check-in: " . $row["check_in"] . "</p>";
                echo "<p>Check-out: " . $row["check_out"] . "</p>";
                echo "<p>Number of Guests: " . $row["guests"] . "</p>";
                echo "<p>Number of Days: " . $row["days"] . "</p>";
                echo "<p>Room Type: " . $row["room_type"] . "</p>";
                echo "<p>Payment Mode: " . $row["payment_mode"] . "</p>";
            } else {
                echo "<p>No bookings found for this room.</p>";
            }

            $conn->close();
        } else {
            echo "<p>Invalid request</p>";
        }
        ?>
    </div>
</body>

</html>

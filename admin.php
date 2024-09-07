<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/hotel1.jpg') no-repeat center center/cover;
            font-size: 20px;
            font-style: italic;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .room-list {
            list-style-type: none;
            padding: 0;
        }

        .room-item {
            cursor: pointer;
            padding: 10px;
            margin: 10px 0;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .room-item a {
            text-decoration: none; 
            color: white; 
        }

        .room-item:hover {
            background-color: #ddd;
        }

        .details {
            margin-top: 20px;
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
    position: fixed;
    top: 20px;
    right: 20px;
}

    </style>
</head>

<body>
    <div class="container">
    <a href="remove.php" class="remove-btn">Remove</a>
        <center>
        <h1>Total Rooms</h1></center>
        <ul class="room-list">
            <?php
            $host = "localhost";
            $user = "root";
            $password = "";
            $db = "booking";

            $conn = new mysqli($host, $user, $password, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, name FROM rooms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $roomId = $row["id"];
                    $roomName = $row["name"];
                    echo '<li class="room-item"><a href="details.php?roomId=' . $roomId . '">' . $roomName . '</a></li>';

                }
            } else {
                echo '<li>No rooms available</li>';
            }

            $conn->close();
            ?>
        </ul>
    </div>
</body>

</html>

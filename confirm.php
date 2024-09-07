<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/room2.jpg') no-repeat center center/cover;
        }

        .confirmation-container {
            background-color: rgba(0,0,0,0.7);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.7);
            color: white;
        }

        h2 {
            color: #4CAF50;
        }

        p {
            margin-bottom: 10px;
        }

        .back-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>

<body>
<div class="confirmation-container">
        <h2>Booking Confirmation</h2>
        <p>Your booking has been confirmed!</p>
        <p><strong>Room Number:</strong> <?php echo $_GET['roomId']; ?></p>
        <p><strong>Check-in Date:</strong> <?php echo $_GET['checkInDate']; ?></p>
        <p><strong>Check-out Date:</strong> <?php echo $_GET['checkOutDate']; ?></p>
        <p><strong>Number of Guests:</strong> <?php echo $_GET['guests']; ?></p>
        <p><strong>Number of Days:</strong> <?php echo $_GET['days']; ?></p>
        <p><strong>Room Type:</strong> <?php echo $_GET['roomType']; ?></p>
        <p><strong>Payment Mode:</strong> <?php echo $_GET['paymentMode']; ?></p>

        <a href="home.php" class="back-btn">Back to Home</a>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Return Form</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
    margin-top: 100px;
    font-size: 30px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.header {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
            margin-top:0;
            font-size: 30px;
            background-color: #333;
            padding: 20px;
        }
      
        .footer {
            text-align: center;
            margin-top:300px;
            padding: 30px;
            background-color:#333;
            color: #fff;
        }

label {
    font-size: 18px;
    margin-bottom: 10px;
}

input[type="date"],
input[type="text"],
input[type="number"],
input[type="tel"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 20px;
}

input[type="submit"] {
    padding: 15px 30px;
    background-color: #668fe1;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0703e9a1;
    transform: scale(1.1);
}

form[action="http://localhost/sportsproject/tyr.php"] input[type="submit"] {
    margin-top: 40px;
}
    </style>
</head>
<body>
<div class="header">
        <h1 style="font-size:xx-large;">Return Form</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="date">Date Borrowed:</label><br>
        <input type="date" id="date" name="date" required><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="equipment">Equipment:</label><br>
        <input type="text" id="equipment" name="equipment" required><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required><br>
        <label for="category">Category of Sport:</label><br>
        <input type="text" id="category" name="category" required><br>
        <label for="phone">Phone No:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <form action="http://localhost/sportsproject/tyr.php" method="post">
    <input type="submit" name="next" value="Go to Next Page">

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a connection to the MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sports";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $date = $_POST['date'];
    $name = $_POST['name'];
    $equipment = $_POST['equipment'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $phone = $_POST['phone'];

    // Check if equipment exists in equipment_nava table
    $checkNavaSql = "SELECT equip_id FROM equipment_nava WHERE equip_id = (SELECT equip_id FROM equipment_ava WHERE equip_name = '$equipment' LIMIT 1)";
    $checkNavaResult = $conn->query($checkNavaSql);

    if ($checkNavaResult->num_rows > 0) {
        // Update equipment_ava table
        $updateAvaSql = "UPDATE equipment_ava SET quantity = quantity + $quantity WHERE equip_name = '$equipment'";
        $conn->query($updateAvaSql);

        // Update entries in equipment_nava table
        $updateNavaSql = "UPDATE equipment_nava SET qnt_b = qnt_b - $quantity WHERE equip_id = (SELECT equip_id FROM equipment_ava WHERE equip_name = '$equipment' LIMIT 1) AND qnt_b >= $quantity";
        $conn->query($updateNavaSql);

        // Check if equipment quantity in equipment_nava is zero
        $checkQuantitySql = "SELECT qnt_b FROM equipment_nava WHERE equip_id = (SELECT equip_id FROM equipment_ava WHERE equip_name = '$equipment' LIMIT 1)";
        $quantityResult = $conn->query($checkQuantitySql);

        if ($quantityResult->num_rows > 0) {
            $row = $quantityResult->fetch_assoc();
            $currentQuantityNava = $row['qnt_b'];

            if ($currentQuantityNava <= 0) {
                // If quantity in equipment_nava is zero or less, delete the row
                $deleteNavaSql = "DELETE FROM equipment_nava WHERE equip_id = (SELECT equip_id FROM equipment_ava WHERE equip_name = '$equipment' LIMIT 1)";
                $conn->query($deleteNavaSql);
            }
        }

        echo "Return submitted successfully!";
    } else {
        echo "Equipment cannot be returned because it does not exist in the inventory (equipment_nava).";
    }

    // Close the database connection
    $conn->close();
}
?>


    <div class="footer">
        <p>&copy; 2024 Sports Equipment Management System. All rights reserved.</p>
    </div>
</body>
</html>
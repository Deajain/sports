
<!DOCTYPE html>
<html lang="en">
<head>
<style>body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #668fe1;
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
    margin-bottom: 30px;
    margin-top: 100px;
    font-size: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

th {
    background-color: #f2f2f2;
}

input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="checkbox"] {
    margin-left: 10px;
}

button[type="submit"] {
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
    margin-top: 20px;
    margin-left: 50%;
}

button[type="submit"]:hover {
    background-color: #0703e9a1;
    transform: scale(1.1);
}

form[action="http://localhost/sportsproject/tyb.php"] input[type="submit"] {
    margin-top: 40px;
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
        #a{
            margin-left: 49%;
        }
        </style>
    <title>Borrow</title>
</head>
<body>
<div class="header">
        <h2 style="font-size:xx-large;">Equipments List</h2>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Equipment</th>
                <th>Quantity Available</th>
                <th>Select</th>
            </tr>
            
<?php
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

// Retrieve data from the equipment_ava table
$sql = "SELECT * FROM equipment_ava";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['equip_id'] . "</td>";
        echo "<td>" . $row['category_name'] . "</td>";
        echo "<td>" . $row['equip_name'] . "</td>";
        echo "<td>";
        echo "<input type='number' name='quantity[]' min='0' max='" . $row['quantity'] . "' value='0'>";
        echo "</td>";
        echo "<td><input type='checkbox' name='selected[]' value='" . $row['equip_id'] . "'></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No equipment available</td></tr>";
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected']) && isset($_POST['quantity'])) {
        $selected = $_POST['selected'];
        $quantities = $_POST['quantity'];

        $selectedEquipmentCount = count($selected);
        $selectedEquipment = [];

        // Insert selected items into the transactions table
        foreach ($selected as $index => $equip_id) {
            $quantity = $quantities[$index];

            if ($quantity > 0) {
                $selectedEquipment[] = $equip_id;

                $insertSql = "INSERT INTO transactions (user_id, equip_id, quantity) VALUES (1, $equip_id, $quantity)";
                $conn->query($insertSql);

                // Subtract the selected quantity from the equipment_ava table
                $updateSql = "UPDATE equipment_ava SET quantity = quantity - $quantity WHERE equip_id = $equip_id";
                $conn->query($updateSql);

                // Remove the equipment if the quantity becomes zero
                $deleteSql = "DELETE FROM equipment_ava WHERE equip_id = $equip_id AND quantity = 0";
                $conn->query($deleteSql);

                // Insert data into the equipment_nava table
                $insertNavaSql = "INSERT INTO equipment_nava (equip_id, qnt_b) VALUES ($equip_id, $quantity)";
                $conn->query($insertNavaSql);
            }
        }
            echo "Borrow successful!";
}
}
// Close the database connection
$conn->close();
?>

        </table>
        <button type="submit" id="a">Borrow</button>
    </form><br><br>
    <form action="http://localhost/sportsproject/tyb.php" method="post">
    <Button type="submit" >Done</button>
    </form>
    <div class="footer">
        <p>&copy; 2024 Sports Equipment Management System. All rights reserved.</p>
    </div>
</body>
</html>
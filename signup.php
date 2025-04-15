<html lang="en">
<head>
    <title>Sign up</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container {
    max-width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    margin-top: 50px;
    font-size: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-size: 16px;
    margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
    width: 250px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 12px;
}

input[type="submit"] {
    padding: 12px 24px;
    background-color: #668fe1;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0703e9a1;
    transform: scale(1.1);
}

a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
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
    </style>
</head>
<body>
<div class="header">
        <h2 style="font-size:xx-large;">Sign up</h2>
    </div>
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

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve the form values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Prepare and execute the SQL query
        $query = "INSERT INTO users (username, email, address, phone, password) VALUES ('$name', '$email', '$address', '$phone', '$password')";
        $success = $conn->query($query);

        // Check if the query was successful
        if ($success) {
            echo "Registration successful!
                  Now go to log in.";
        } else {
            echo "Error: Please try again ";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>
        <label for="phone">Phone No:</label>
        <input type="tel" id="phone" name="phone" required><br>
        <label for="password">Create Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="submit" value="Register"><br>
        Already have an account? <a href="http://localhost/sportsproject/login.php/">Log in</a><br>
    </form>
    <div class="footer">
        <p>&copy; 2024 Sports Equipment Management System. All rights reserved.</p>
    </div>
</body>
</html>


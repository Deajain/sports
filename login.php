<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
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

    input[type="email"],
    input[type="password"] {
        width: 250px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 20px;
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

    .header {
        text-align: center;
        color: #fff;
        font-size: 30px;
        background-color: #333;
        padding: 20px;
    }

    .footer {
        text-align: center;
        margin-top: 50px;
        padding: 30px;
        background-color: #333;
        color: #fff;
    }

    .message {
        text-align: center;
        font-size: 16px;
        margin-top: 10px;
    }

    .success {
        color: green;
    }

    .error {
        color: red;
    }

    .options-button {
        text-align: center;
        margin-top: 20px;
    }

    .options-button input[type="submit"] {
        padding: 10px 25px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .options-button input[type="submit"]:hover {
        background-color: #218838;
    }
    </style>
</head>
<body>

    <div class="header">
        <h2>Log in</h2>
    </div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sports";

$conn = new mysqli($servername, $username, $password, $dbname);
$showButton = false;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="message">';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            echo "<p class='success'>Login successful!</p>";
            $showButton = true;
        } else {
            echo "<p class='error'>Incorrect password!</p>";
        }
    } else {
        echo "<p class='error'>Email not found!</p>";
    }
    echo '</div>';

    $stmt->close();
}

$conn->close();
?>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="submit" value="Login">
            <br>
            <p>Don't have an account? <a href="http://localhost/sportsproject/signup.php/">Sign up here</a></p>
        </form>

        <?php if ($showButton): ?>
        <div class="options-button">
            <form action="http://localhost/sportsproject/option.php/" method="post">
                <input type="submit" value="Go to Options">
            </form>
        </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 Sports Equipment Management System. All rights reserved.</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
   <style>
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
            margin-bottom: 30px;
            margin-top: 100px;
            font-size:50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .button-container a {
            text-decoration: none;
            margin-right: 20px;
        }
        .button {
            display: inline-block;
            padding:30px 60px;
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
        }
        .button:last-child {
            background-color: #668fe1;
        }
        .button:hover {
            background-color: #0703e9a1;
            transform: scale(1.1);
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
   </style>
    <title>Choose Action</title>
</head>
<body>
<div class="header">
        <h2 style="font-size:xx-large;">Please select</h2>
    </div>
    <div style="display: flex; justify-content: center;">
        <a href="http://localhost/sportsproject/borrow.php/" style="margin-right: 20px;"><button class="button">Borrow</button></a>
        <a href="http://localhost/sportsproject/return.php/" style="margin-right: 20px";><button class="button">Return</button></a>
    </div>
    <div class="footer">
        <p>&copy; 2024 Sports Equipment Management System. All rights reserved.</p>
    </div>
</body>
</html>

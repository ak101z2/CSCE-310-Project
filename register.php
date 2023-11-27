<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }
        form {
            display: inline-block;
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form action="register.php" method="post">
    <h2>Register</h2>
    <label for="uin">UIN:</label>
    <input type="number" name="uin" required><br>
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" required><br>
    <label for="mInitial">Middle Initial:</label>
    <input type="text" name="mInitial" maxlength="1"><br>
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" required><br>
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <label for="userType">User Type:</label>
    <input type="text" name="userType" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="discordName">Discord Name:</label>
    <input type="text" name="discordName" required><br>
    <input type="submit" value="Register">
    <a href="login.php">Already have an account?</a>
</form>

</body>
</html>

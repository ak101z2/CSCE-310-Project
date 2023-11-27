<html>
<body>
<head>
  <link rel="stylesheet" href="login.css">
</head>

<ul>
  <li><a href="dummy1.php">Dummy 1</a></li>
  <li><a href="dummy2.php">Dummy 2</a></li>
  <li><a href="dummy3.php">Dummy 3</a></li>
  <li style="float:right"><a href="login.php">Logout</a></li>
</ul>

<form action="loginCheck.php" method="post">
  <div class="container">
    <label for="UIN"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>

</form>

</body>
</html>
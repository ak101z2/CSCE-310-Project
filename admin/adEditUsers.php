<html>
<body>
<head>
  <link rel="stylesheet" href="adEditUsers.css">
</head>

<div class="navbar">
  <a href="#">Home</a>
  <div class="dropdown">
    <button class="dropbtn">User Auth & Roles 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Program Info Management 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Proram Progress Tracking 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Event Management 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
</div>

<h1>Add new User</h1>

<form action="adEditUsersBTS.php" method="post">
  <div class="container">

    <div class = "hold">
        <label for="First_Name"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="First_Name" id="First_Name" required>

        <label for="M_Initial"><b>M Initial</b></label>
        <input type="text" placeholder="Enter M Initial" name="M_Initial" id="M_Initial" required>
    </div>

    <div class = "hold">
        <label for="Last_Name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="Last_Name" id="Last_Name" required>

        <label for="Username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="Username" id="Username" required>
    </div>

    <div class = "hold">
        <label for="Passwords"><b>Passwords</b></label>
        <input type="text" placeholder="Enter Passwords" name="Passwords" id="Passwords" required>

        <label for="User_Type"><b>User Type</b></label>
        <select name="cars" id="cars">
            <option value="ADMIN">ADMIN</option>
            <option value="COLLEGE STUDENT">COLLEGE STUDENT</option>
            <option value="NON COLLEGE STUDENT">NON COLLEGE STUDENT</option>
        </select>

    </div>
    <div class = "hold">
        <label for="Email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="Email" id="Email" required>

        <label for="Discord_Name"><b>Discord Name</b></label>
        <input type="text" placeholder="Enter Discord Name" name="Discord_Name" id="Discord_Name" required>
    </div>
  </div>

  <hr>

  <button type="submit" class="registerbtn">Register</button>

</form>
</body>
</html>
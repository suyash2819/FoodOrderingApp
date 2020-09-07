<html>

<head>
    <?php include 'links.php'?>
    <link rel="stylesheet" type="text/css" href="CSS/Login.css">

</head>

<body>
    <?php include './Navbar.php'; ?>

    <div class="container">
        <div class="row center">
            <div class="card" style="width: 50%;height:30rem;">
                <img class='card-img' src="./Images/Login.jpg" alt="Card image cap">
            </div>
            <div class="card" style="width: 50%;height:30rem">
                <center>
                    <h5 class="card-title" style="margin-top:15px;">
                        Login as Customer/Restaurant
                    </h5>
                </center>
                <form method="post" id="register-form">

                    <div class="form-group">
                        <span class="label">Email</span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"
                            required>
                    </div>
                    <div class="form-group">
                        <span class="label">Password</span><input type="password" class="form-control" id="password"
                            placeholder="Enter Password" name="password" required>
                    </div>
                    <center><button type="submit" class="btn btn-primary" name="submit">Login</button></center>
                </form>
            </div>
        </div>
    </div>

    <?php

$email=isset($_POST['email'])?$_POST['email']:"";
$password=isset($_POST['password'])?$_POST['password']:"";
 
 if(isset($_POST['submit'])){
   login($email,$password);
 }


  function cleanData($data)
  {
  $data=trim($data);
  $data=htmlspecialchars($data);
  return $data;
  }

  function login($email,$password)
  {
    if(empty($email)||empty($password)){
        ?>
    <script>
    alert("Password and Email both are required for logging in")
    </script>
    <?php exit; } 
   else{
    $email=cleanData($_POST['email']);
    $password=cleanData($_POST['password']);
    include './dbConnect.php';

    $hashedpwd=md5($password);

    $queryuser="SELECT * FROM customer WHERE Email='$email' and Password='$hashedpwd'";
    $queryrunuser=mysqli_query($conn,$queryuser);
    $queryrest="SELECT * FROM restaurants WHERE Email='$email' and Password='$hashedpwd'";
    $queryrunrest=mysqli_query($conn,$queryrest);
    if (mysqli_num_rows($queryrunuser)>0) {
        ?>
    <script>
    alert("login successful");
    window.location = "./Index.php";
    </script>
    <?php
      while($row=mysqli_fetch_assoc($queryrunuser))
      {
        $_SESSION['username']=$row['Name'];
        $_SESSION['email']=$row['Email'];
        $_SESSION['userid']=$row['UserId'];
      }
    }
      elseif (mysqli_num_rows($queryrunrest)>0) {
        ?>
    <script>
    alert("login successful");
    window.location = "./Index.php";
    </script>
    <?php
        while($row=mysqli_fetch_assoc($queryrunrest))
        {
          $_SESSION['restaurantname']=$row['Name'];
          $_SESSION['restautantemail']=$row['Email'];
          $_SESSION['restid']=$row['RestaurantId'];
        }
    }
    else { ?>
    <script>
    alert("wrong email or password");
    window.location = "./Index.php";
    </script>
    <?php } } } ?>
</body>

</html>
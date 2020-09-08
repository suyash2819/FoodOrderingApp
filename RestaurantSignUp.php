<html>

<head>
    <?php include 'links.php'; ?>
    <link rel="stylesheet" type="text/css" href="CSS/Restaurant.css">

</head>

<body>
    <?php include './Navbar.php';?>
    <div class="container">
        <div class="row center">
            <div class="card" style="width: 50%;height:30rem;">
                <img class='card-img' src="./Images/Restaurant.jpg" alt="Card image cap">
            </div>
            <div class="card" style="width: 50%;height:30rem">

                <form method="post" id="register-form">

                    <div class="form-group">
                        <span class="label">Restaurant Name</span>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Restaurant Contact Number</span>
                        <input type="tel" class="form-control" id="phone" name="contact"
                            placeholder="Enter Contact Number" pattern="^[0-9]\d{9}$" required>
                    </div>

                    <div class="form-group">
                        <span class="label">Restaurant Address</span> <input type="text" class="form-control"
                            id="address" placeholder="Enter Address" name="address" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Email address</span> <input type="email" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email"
                            required>
                    </div>
                    <div class="form-group">
                        <span class="label">Password</span><input type="password" class="form-control"
                            id="exampleInputPassword1" placeholder="Password" name="pass" minlength="6" required>
                    </div>
                    <center><button type="submit" class="btn btn-primary" name="submit">Register</button></center>
                </form>
            </div>
        </div>
    </div>
    <?php 
  
    $restid="";
    $name="";
    $contactno="";
    $address="";
    $email="";
    $password="";  
    $error=array();
    
    if(isset($_POST['submit'])){
        include './dbConnect.php';
        $restid="";
        $name=cleanData($_POST['fullname']);
        $contactno=cleanData($_POST['contact']);
        $address=cleanData($_POST['address']);
        $email=cleanData($_POST['email']);
        $password=$_POST['pass'];  
        $checkEmail="SELECT * FROM restaurants r, customer c WHERE r.Email='$email' or c.Email='$email'";
        $runqueryemail=mysqli_query($conn,$checkEmail);
        if(mysqli_num_rows($runqueryemail) > 0)
        {
            ?>
    <script>
    alert("Email is already in use");
    </script>
    <?php
    exit;
    }
    register($restid,$name,$contactno,$address,$email,$password);
    }

    function cleanData($data)
    {
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }


    function register($restid,$name,$contactno,$address,$email,$password)
    {
     $hashedpwd=md5($password); 
     include './dbConnect.php'; 
    $query="INSERT INTO restaurants VALUES('$restid','$name','$contactno','$address','$email','$hashedpwd')";
    if(mysqli_query($conn, $query)){
    ?>
    <script>
    alert("Registered Successfully");
    window.location = "./Index.php";
    </script>
    <?php

        }
    }
    
?>
</body>

</html>
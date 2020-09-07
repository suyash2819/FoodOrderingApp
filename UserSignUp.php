<html>

<head>
    <?php include 'links.php'?>
    <link rel="stylesheet" type="text/css" href="CSS/UserSignUp.css">

</head>

<body>
    <?php include './Navbar.php'; ?>
    <div class="container">
        <div class="row center">
            <div class="card" style="width: 50%;height:30rem;">
                <img class='card-img' src="./Images/food.jpg" alt="Card image cap">
            </div>
            <div class="card" style="width: 50%;height:30rem">

                <form method="post" id="register-form">

                    <div class="form-group">
                        <span class="label">Name</span>
                        <input type="text" class="form-control" id="fullname" placeholder="Enter full name"
                            name="fullname" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Contact Number</span>
                        <input type="tel" class="form-control" id="phone" name="contact"
                            placeholder="Enter Contact Number" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Address</span> <input type="text" class="form-control" id="address"
                            name="address" placeholder="Enter Address" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Preference</span><input type="text" class="form-control" id="preference"
                            name="preference" placeholder="Veg or Non-Veg" required>
                    </div>

                    <div class="form-group">
                        <span class="label">Email address</span> <input type="email" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email"
                            required>
                    </div>
                    <div class="form-group">
                        <span class="label">Password</span><input type="password" class="form-control"
                            id="exampleInputPassword1" placeholder="Password" name="pass" required>
                    </div>
                    <center><button type="submit" class="btn btn-primary" name="submit-user"
                            value="Register">Register</button>
                    </center>
                </form>
            </div>

        </div>
    </div>
    <?php 
  
    $uid="";
    $name="";
    $contactno="";
    $address="";
    $preference="";
    $email="";
    $password="";  
    $error=array();
    
    if(isset($_POST['submit-user'])){
        $uid="";
        $name=cleanData($_POST['fullname']);
        $contactno=cleanData($_POST['contact']);
        $address=cleanData($_POST['address']);
        $preference=cleanData($_POST['preference']);
        $email=cleanData($_POST['email']);
        $password=$_POST['pass'];  
        include './dbConnect.php';
        $checkEmail="SELECT * FROM customer WHERE Email='$email'";
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
    register($uid,$name,$contactno,$address,$preference,$email,$password);
    }

    function cleanData($data)
    {
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }


    function register($uid,$name,$contactno,$address,$preference,$email,$password)
    {
    include './dbConnect.php';

    $hashedpwd=md5($password);
    $query="INSERT INTO customer VALUES('$uid','$name','$contactno','$address','$preference','$email','$hashedpwd')";
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
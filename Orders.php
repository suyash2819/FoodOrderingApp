<?php 
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) &&!isset($_SESSION['restaurantname']) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
         die( "Your are Not Authorized to access this page" );
    }
?>
<html>

<head>
    <?php include './links.php'; ?>
    <link rel="stylesheet" type="text/css" href="CSS/AddToMenu.css">
</head>

<body>
    <?php include './Navbar.php'; ?>
    <center>
        <h2 style="color:white;">Orders For <?php echo $_SESSION['restaurantname']?> </h2>
        <table class="table table-striped table-dark" style="Margin-top:40px;width:90%">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Food Item Ordered</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                </tr>
            </thead>
            <tbody>
                <?php 
             include './dbConnect.php';
             $restid=$_SESSION['restid'];
             $query="SELECT o.OrderId,c.Name,c.Email,f.ItemName FROM orders o INNER JOIN customer c ON o.UserId=c.UserId INNER JOIN fooditems f
              ON f.ItemId=o.ItemId INNER JOIN restaurants r ON o.RestaurantId=r.RestaurantId WHERE o.RestaurantId=$restid" ;           
             $queryrun=mysqli_query($conn, $query);
             if(mysqli_num_rows($queryrun)>0)
             {
                 while($row=mysqli_fetch_assoc($queryrun))
                 {
                     ?>
                <tr>
                    <td><?php echo $row['OrderId'] ?></td>
                    <td><?php echo $row['ItemName']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Email']?></td>
                </tr>

                <?php
                 }
             }   
            ?>
            </tbody>

        </table>
    </center>
</body>

</html>
<html>

<head>
    <?php include './links.php'; ?>
    <link rel="stylesheet" type="text/css" href="CSS/ViewMenu.css">
</head>

<body>
    <?php include './Navbar.php'; ?>

    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">
            <?php 
                include './dbConnect.php';
                $query="SELECT f.ItemName, f.Price, f.ItemImage, f.Type,f.ItemId,f.RestaurantId, r.Name FROM fooditems f INNER JOIN restaurants r on f.RestaurantId=r.RestaurantId";           
                $queryrun=mysqli_query($conn, $query);
                if(mysqli_num_rows($queryrun)>0)
                {
                    while($row=mysqli_fetch_assoc($queryrun))
                    {
            ?>
            <div class="col-md-3" style="margin-bottom:10px">
                <div class="card" style="height: 400px;">
                    <?php 
                    echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($row['ItemImage']).'"
                        alt="Card image cap" style="width:100%;height: 200px; object-fit: cover;">'
                        ?>
                    <div class="card-body">
                        <h5 class="card-title restaurant" id="<?php echo $row['RestaurantId'] ?>">
                            <?php echo $row['Name'] ?></h5>
                        <p class="card-text"><?php echo $row['ItemName'].' ('.$row['Type'].')' ?></p>
                        <p class="card-text">Rs <?php echo $row['Price'] ?></p>
                        <form method="post">
                            <input type="hidden" id="itemid" name="itemid" value="<?php  echo $row['ItemId'] ?>">
                            <input type="hidden" id="restid" name="restid" value="<?php echo $row['RestaurantId'] ?>">
                            <button type="submit" name="submit" class="btn btn-success submit" id="">Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                 }
             }else
             {
                 ?>
            <script>
            alert("None of the restaurants have added any item yet");
            </script>
            <?php
             }   
            ?>
        </div>
    </div>
</body>

</html>
<?php 
if(isset($_POST['submit'])){
if(!isset($_SESSION['username'])&&!isset($_SESSION['restaurantname']))
{
?>
<script>
alert("Please Login as customer To Order");
window.location = "./Login.php";
</script>
<?php } elseif(isset($_SESSION['restaurantname'])) { ?>
<script>
alert("Restaurants cannot order");
window.location = "./ViewMenu.php";
</script>
<?php } else{
  include './dbConnect.php';
  $restaurantid=$_POST['restid'];
  $itemid=$_POST['itemid'];
  $query="INSERT INTO orders VALUES('','$restaurantid','$itemid','{$_SESSION['userid']}')"; 
  $queryrun=mysqli_query($conn,$query);
  if($queryrun)
  {
?>
<script>
alert("Your order has been successfully placed");
window.location = "./ViewMenu.php";
</script>
<?php
}
} } 
?>
<html>
<?php 
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) &&!isset($_SESSION['restaurantname']) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
         die( "Your are Not Authorized to access this page" );
    }
?>

<head>
    <?php include 'links.php'?>
    <link rel="stylesheet" type="text/css" href="CSS/AddToMenu.css">
</head>

<body>
    <?php
    include './Navbar.php'; ?>
    <div class="container">
        <div class="row center">
            <div class="card" style="width: 50%;height:30rem;">
                <img class='card-img' src="./Images/Menu.jpg" alt="Card image cap">
            </div>
            <div class="card" style="width: 50%;height:30rem">

                <form method="post" id="register-form" enctype="multipart/form-data">

                    <div class="form-group">
                        <span class="label">Food Item Name</span>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            placeholder="Enter food item name" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Type</span>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Veg or Non-Veg"
                            required>
                    </div>

                    <div class="form-group">
                        <span class="label">Price/span> <input type="number" class="form-control" id="price"
                                placeholder="Enter Price in rs" name="price" required>
                    </div>
                    <div class="form-group">
                        <span class="label">Image For Food Item</span><input type="file" class="form-control" id="image"
                            name="image">
                    </div>
                    <center><button type="submit" class="btn btn-primary" name="submit" id="submit">Register</button>
                    </center>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $('#submit').click(function() {
        var image_name = $('#image').val();
        if (image_name !== '') {
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("invalid image file");
                $('#image').val('');
                return false;
            }

        }
    });
});
</script>
<?php 
    $itemid="";
    $restid=$_SESSION['restid'];
    $name="";
    $type="";
    $price="";
    $image="";

    if(isset($_POST['submit'])){
        include './dbConnect.php';

        $image=mysqli_real_escape_string($conn,file_get_contents($_FILES["image"]["tmp_name"]));
        $itemid="";
        $restid=$_SESSION['restid'];
        $name=cleanData($_POST['fullname']);
        $type=cleanData($_POST['type']);
        $price=cleanData($_POST['price']);
        
        addToMenu($itemid,$restid,$name,$type,$price,$image);
      }

    function cleanData($data)
    {
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }

    function addToMenu($itemid,$restid,$name,$type,$price,$image)
    {
        include './dbConnect.php';
        $query="INSERT INTO fooditems VALUES('$itemid','$restid','$name','$type','$price','$image')";
        if(mysqli_query($conn, $query)) {
        ?>
<script>
alert("Item Added Successfully");
window.location = "./AddToMenu.php";
</script>
<?php
    
            }
    }
    
?>
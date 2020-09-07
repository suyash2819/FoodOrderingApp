 <?php
  $host="localhost";
  $user="root";
  $password="";
  $conn=@mysqli_connect($host,$user,$password,'foodshala');
  if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

 ?>
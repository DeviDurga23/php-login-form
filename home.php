<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
?>
<!DOCTYPE html>
<html>
  <head>
      <title>
      HOME
    </title>
    <body style="text-align: center; padding: 50px;justify-content:center;margin:230px;background-color:bisque">
      <h1>Hello,<?php echo $_SESSION['user_name'];?></h1>
      <br> <!-- Add a line break here -->
      <a  href="logout.php" style="display: inline-block; padding: 10px 20px; background-color: #ff0000; color: #ffffff; text-decoration: none; border-radius: 5px;justify-content:center">Logout</a>
    </body>
  </head>
</html>
<?php
}
else{
  header("Location : index.php");
  exit();
}
?>
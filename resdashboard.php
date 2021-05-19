<?php
session_start();

if (!isset($_SESSION['reslogin'])) {
    $_SESSION['msg']="You are not authorized to access this page";
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>
<?php include 'nav.php'; 
    include 'msg.php';
?>
       

</body>

</html>
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: rlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="heading">
         
        </div>
    </div>

</body>

</html>
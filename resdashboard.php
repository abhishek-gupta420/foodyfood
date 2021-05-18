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
        if(isset($_SESSION['msg'])){?>
           
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> <?php echo $_SESSION['msg']?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
            </div>
            <?php
            unset($_SESSION['msg']);
        }
        ?>

</body>

</html>
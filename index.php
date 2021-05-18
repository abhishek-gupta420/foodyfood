<?php
session_start();

include 'dbcon.php';
$sql = "SELECT * FROM menu ";

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <div>
        <?php include 'nav.php';
        if (isset($_SESSION['msg'])) { ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong> <?php echo $_SESSION['msg'] ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        <?php
            unset($_SESSION['msg']);
        }
        ?>
    </div>
    
        <div class="container-fluid">
            <div class="container" style="align-items: center; text-align: center;margin-bottom: 50px;margin-top: 20px;">
                <h3>Order Your with Foody Food</h3>

            </div><hr>

    

            <div class="container"><?php
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
            <div class="row">
                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4" style=" margin-bottom: 25px;">
                        <div class="card d-flex" style="width: 18rem;">
                            <img class="card-img-top" width="200" height="200" src="images/<?php echo $row['image'] ?>" alt="image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name'] ?> (<?php echo $row['category'] ?>)</h5>

                                <p class="card-text">
                                <h4>Only @ <?php echo $row['price'] ?> </h4>
                                </p>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php   } ?>
            </div>

            <?php
                            } else {
                                echo "0 results";
                            }
        ?>
    </div>
    </div>

</body>

</html>
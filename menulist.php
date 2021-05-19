<?php
session_start();
if(!isset($_SESSION['reslogin'])){
    $_SESSION['msg']="you are not allowed to access this page ";
    header('location: index.php');
}
include 'dbcon.php';
$res_id = $_SESSION['res_id'];

$sql = "SELECT * FROM menu where res_id = '$res_id'";

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
   
        <?php 
        include 'nav.php';    
        include 'msg.php';
     ?>
    

    <div class="container-fluid">
        <div class="container" style="align-items: center; text-align: center;margin-bottom: 50px;margin-top: 20px;">
            <h3>The Menu Items Added by : <?php echo $_SESSION['name'] ?></h3>

        </div>
        <hr>



        <div class="container"><?php
            $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id']?></th>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['price']?></td>
                                        <td><?php echo $row['category']?></td>
                                        <td><img src="images/<?php echo $row['image']?>" width="100" height="100"></td>
                                        <td><a href="editmenu.php?id=<?php echo $row['id'] ?>" class="btn btn-success">E D I T</a></td>
                                        <td><a href="deletemenu.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                                       
                                        
                                    </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php }
                ?>

            
        </div>
    </div>

</body>

</html>
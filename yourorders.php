<?php 
    session_start();
    include 'dbcon.php';
    $c_id = $_SESSION['c_id'];
   
    $sql = "SELECT * FROM orders where c_id = $c_id ORDER BY date DESC";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "head.php"?>
<body>
<?php include "nav.php";
        include "msg.php";
?>
    <div class="container-fluid">
        <div class="container" style="align-items: center; text-align: center;margin-bottom: 50px;margin-top: 20px;">
            <h3>The Food Ordered by : <?php echo $_SESSION['name'] ?></h3>

        </div>
        <hr>



        <div class="container"><?php
            $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                              
                                    <tr>
                                        <th scope="row"><?php echo $row['order_id']?></th>
                                        <td><?php echo $row['item']?></td>
                                        <td><?php echo $row['price']?></td>
                                     
                                        <td><?php echo date("d-M-Y",strtotime($row['date']))?></td>
                                        <td><?php echo date("h : i A",strtotime($row['date']))?></td>
                                        
                                    </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php }else{
                        $_SESSION['msg']="Currently You do not have any orders. Place your order with foodyfood";
                    }
                ?>

            
        </div>
    </div>
</body>
</html>
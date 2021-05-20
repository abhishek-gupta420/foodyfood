<?php
session_start();

if (!isset($_SESSION['reslogin'])) {
    $_SESSION['msg']="You are not authorized to access this page";
    header('location: index.php');
}
include 'dbcon.php';
    $res_id = $_SESSION['res_id'];
   
    $sql = "SELECT * FROM orders where res_id = $res_id ORDER BY date DESC";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Foody Shala</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="5">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php include 'nav.php'; 
    include 'msg.php';
?>
       <div class="container-fluid">
        <div class="container" style="align-items: center; text-align: center;margin-bottom: 50px;margin-top: 20px;">
            <h3>Orders Received : <?php echo $_SESSION['name'] ?></h3>

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
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Mobile</th>
                                <th scope="col">Delivery Address</th>
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
                                        <td><?php echo $row['c_name']?></td>
                                        <td><?php echo $row['c_mobile']?></td>
                                        <td><?php echo $row['c_address']?></td>
                                        <td><?php echo date("d-M-Y",strtotime($row['date']))?></td>
                                        <td><?php echo date("h : i A",strtotime($row['date']))?></td>
                                        
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
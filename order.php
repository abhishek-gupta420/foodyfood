<?php 
session_start();

    if(isset($_SESSION['clogin'])!==true){
        $_SESSION['msg'] = "please Login to your account for placing an order" ;
        header("location: clogin.php");
    }
    $id = $_GET['id'];
    echo $sql = "select * from menu where id = $id";
    include 'dbcon.php';
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        
        $item = $row['name'];
        
        $price = $row['price'];
        
        $res_id = $row['res_id'];

        $c_address = $_SESSION['address'];

        $c_id = $_SESSION['c_id'];

        $c_mobile = $_SESSION['mobile'];

        $makeorder = "INSERT INTO ORDERS (item, price, c_address, c_mobile, c_id, res_id, date) 
        VALUES ('$item', '$price', '$c_address', '$c_mobile', '$c_id', '$res_id', current_timestamp())";

        if(mysqli_query($con,$makeorder)){
            $_SESSION['msg']="your order is placed Successfully and will be delivered to you with in an hour";
            header("location: yourorders.php");
        }
        else{
            $_SESSION['msg']=mysqli_error($con);
            header("location: index.php");
        }
    }



?>
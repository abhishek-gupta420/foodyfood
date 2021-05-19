<?php
session_start();
include 'dbcon.php';
$id= $_GET['id'];


$sql = "select * from menu where id = $id";
$res_id = $_SESSION['res_id'];

/**
 * 
 * validating the authorized restaurant to delete the menu item
 */
echo $res_id;
 $result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
   $check = $row['res_id'];
  $image = $row['image'];

   if($check!=$res_id){
       $_SESSION['msg'] = "Unauthorized Page request";
       header("location: index.php");

   }else{
       
      $delete = "DELETE FROM menu WHERE id = '$id'";
      if(mysqli_query($con,$delete)){
        unlink("images/".$image);
        
        $_SESSION['msg']="Item Deleted Successfully";
        header('location: menulist.php');
      }else{
          $_SESSION['msg']= mysqli_error($con);
          header("location: menulist.php");
      }
   }
}

?>
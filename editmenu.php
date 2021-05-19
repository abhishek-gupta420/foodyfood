<?php
session_start();
/**
 * 
 * checking that only restaurant should come to this page
 */
if (!isset($_SESSION['reslogin'])) {
    $_SESSION['msg'] = "You are not allowed to access this page";
    header('location: index.php');
}
$row = $name = $category = $price = $image = $filename_to_store = $tempname ="";
$oldname = $oldprice = $oldcategory = $oldimage = $menuid= "";
$nameErr = $priceErr = $imageErr = $cErr = "";
$id=$_GET['id'];
include 'dbcon.php';

/**
 * 
 * 
 * 
 * checking the authenticated restaurant to edit or delete the menu item.
 * 
 * 
 */
$query="SELECT * FROM menu WHERE id = '$id'";

$res_id = $_SESSION['res_id'];
// defining variables to show data in the input boxes

$result = mysqli_query($con,$query);
if (mysqli_num_rows($result) > 0){
   
    $row= mysqli_fetch_assoc($result);
    $_SESSION['menuid'] = $row['id'];
    $oldname = $row['name'];
    $oldprice = $row['price'];
    $oldcategory = $row['category'];
    $_SESSION['oldimage'] = $row['image'];
    $check_res = $row['res_id'];        //getting the res.id from menu table
    if($res_id != $check_res ) {
        $_SESSION['msg']="You are not authorized ";
        header("location : index.php");
    }
}





//adding validation to receive fruitful data only


if (isset($_POST['submit'])) {


    /**
     * checking if new image exists or not
     */
    if(empty($_FILES['image']['name'])){
        
         $filename_to_store = $_POST['old-image'];
    }else{

        $filename = $_FILES["image"]["name"];
        $filename = preg_replace("/\s+/", "_", $filename);
        $tempname = $_FILES["image"]["tmp_name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
        $imgtype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        $filename_to_store = $filename.'_'.date('mjYHis').'.'.$imgtype;
    
        
       
        if ($_FILES["image"]["size"] > 5000000) {
            $imageErr = "Image should not be greater than 4.5 mb";
        }
    
        if ($imgtype != "jpg" && $imgtype != "png" && $imgtype != "jpeg") {
            $imageErr = "only JPG, JPEG, PNG files are allowed.";
        }

        if($imageErr==""){
            //uploading image to images folder
            move_uploaded_file($tempname,"images/".$filename_to_store);

            // Deleting old image from images folder 
            unlink("images/".$_SESSION['oldimage']);
        }
        
    }

    if (empty($_POST['name'])) {
        $nameErr = "<p> Please Enter Name </p>";
    }



    if (empty($_POST['price'])) {
        $priceErr = "Please Enter price of Item";
    } elseif (!preg_match("/^[0-9]/", $_POST['price'])) {
        $priceErr = "Price should contain digits ";
    }

    // category validation

    if (!isset($category)) {
        $cErr = "Please select one category";
    }
    /**
     * image validations
     */

    
    

    /**
     * database work starts below
     */

    $name = validate_data(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $price = validate_data(filter_var($_POST["price"], FILTER_VALIDATE_INT));

    $res_id = $_SESSION['res_id'];
    $menuid= $_SESSION['menuid'];

    if (isset($_POST['category'])) {
        $category = $_POST['category'];
    }

 

   


    /**
     * checking if there are no errors 
     */

    if ($nameErr == "" && $cErr == "" && $priceErr == "" && $imageErr == "") {


    

      // $sql = "UPDATE menu SET name='$name', category='$category', price=$price, image='$filename_to_store' WHERE id=$menuid ";
   echo $sql = "UPDATE menu SET name='$name',price='$price',category='$category', `image`='$filename_to_store' WHERE ID = '$menuid'";      
            

       $result = mysqli_query($con, $sql);
        if ($result) {
            
            /**
             * 
             *   reseting the variables
             * 
             */
            $_SESSION['msg']="Changes saved Successfully";
            $success = true;
            $name = "";
            $price = "";
            $category = "";
            $res_id = "";
            $filename_to_store = "";
            unset($_SESSION['oldimage']);
            unset($_SESSION['menuid']);
            header("location: menulist.php");

        } else {
            die(mysqli_error($con));
            $showError = true;
        }
     }
}

function validate_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>
  
    <?php include 'nav.php'; 
      include 'msg.php';
        ?>
    <div class="container">

        <div class="container-card">

            <div class="card" style="width: 40%;">
                <h5 class="card-header">Add Item to Your Menu</h5>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name of Item</label>
                            <input type="text" required class="form-control" id="name" name="name" placeholder="Example: Paneer" value="<?php echo $oldname ?>">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" required class="form-control" id="price" placeholder="Enter Price of Item" name="price" value="<?php echo $oldprice ?>">
                            <span class="text-danger"><?php echo $priceErr ?></span>
                        </div>

                        <div class="form-group">
                            <label for="image">Choose an Image</label>
                            <input type="file" class="form-control" name="image" id="image"><small>existing image is : <?php echo $_SESSION['oldimage']?></small>
                           
                            <span class="text-danger"><?php echo $imageErr ?></span>
                        </div>

                        <div class="form-group col-md-10">
                            <label for="category">Select Category :</label>
                            Veg <input type="radio" id="category" name="category" value="veg" required value="veg"<?php  if($oldcategory=='veg') {echo "checked=checked"; 
                                } ?>  >
                            Non-Veg<input type="radio" id="category" name="category" value="nonveg" required value="nonveg"<?php  if($oldcategory=='nonveg') {echo "checked=checked"; 
                                } ?> >
                            <span class="text-danger"><?php echo $cErr ?></span>
                        </div>
                             
                        <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                        <input type="hidden" name="old-image" value="<?php echo $row['image']?>">
                        <input type="hidden" name="id" value="<?php echo $row['id']?>">
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
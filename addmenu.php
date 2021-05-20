<?php
session_start();
if (!isset($_SESSION['reslogin'])) {
    $_SESSION['msg'] = "You are not allowed to access this page";
    header('location: index.php');
}



$nameErr = $priceErr = $imageErr = $cErr = "";
$name = $category = $price = $image = $filename_to_store = "";

//adding validation to receive fruitful data only


if (isset($_POST['submit'])) {

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
    if (empty($_FILES['image'])) {
        $imageErr = "Please choose an Image";
    }
    $filename = $_FILES["image"]["name"];
    $filename = preg_replace("/\s+/", "_", $filename);
    $tempname = $_FILES["image"]["tmp_name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];
    $imgtype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $filename = pathinfo($filename, PATHINFO_FILENAME);

    
   
    if ($_FILES["image"]["size"] > 5000000) {
        $imageErr = "Image should not be greater than 4.5 mb";
    }

    if ($imgtype != "jpg" && $imgtype != "png" && $imgtype != "jpeg") {
        $imageErr = "only JPG, JPEG, PNG files are allowed.";
    }
    //$filename=$_FILES['image']['name'];


    /**
     * database work starts below
     */

    $name = validate_data(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $price = validate_data(filter_var($_POST["price"], FILTER_VALIDATE_INT));

    $res_id = $_SESSION['res_id'];

    if (isset($_POST['category'])) {
        $category = $_POST['category'];
    }

    //calling dbcon file

    include 'dbcon.php';

   


    /**
     * checking if there are no errors 
     */
    $res_name= $_SESSION['name'];

    if ($nameErr == "" && $cErr == "" && $priceErr == "" && $imageErr == "") {


        $filename_to_store = $filename.'_'.date('mjYHis').'.'.$imgtype;

      echo  $sql = "INSERT INTO menu (name, category, price, image, res_id, res_name, created_at) VALUES ('$name', '$category', '$price', '$filename_to_store','$res_id','$res_name', current_timestamp())";
  
        $result = mysqli_query($con, $sql);
        if ($result) {
            move_uploaded_file($tempname,"images/".$filename_to_store);
            $_SESSION['msg']="Item Added to Menu Successfully";
            $success = true;
            $name = "";
            $price = "";
            $category = "";
            $res_id = "";
            $filename_to_store = "";

            //header("location: addmenu.php");

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
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name of Item</label>
                            <input type="text" required class="form-control" id="name" name="name" placeholder="Example: Paneer" value="<?php echo $name ?>">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" required class="form-control" id="price" placeholder="Enter Price of Item" name="price" value="<?php echo $price ?>">
                            <span class="text-danger"><?php echo $priceErr ?></span>
                        </div>

                        <div class="form-group">
                            <label for="image">Choose an Image</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <span class="text-danger"><?php echo $imageErr ?></span>
                        </div>

                        <div class="form-group col-md-10">
                            <label for="category">Select Category :</label>
                            Veg <input type="radio" id="category" name="category" value="veg" required value="<?php echo $category ?>">
                            Non-Veg<input type="radio" id="category" name="category" value="nonveg" required value="<?php echo $category ?>">
                            <span class="text-danger"><?php echo $cErr ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Add Item</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
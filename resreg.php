<?php
$nameErr = $emailErr = $passwordErr = $cpasswordErr ="";
$name = $email = $password = $cpassword = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //calling dbcon (database file)
        if(empty($_POST['name']))
        {
            $nameErr = "<p> Please Enter Name </p>";
    
        }
     
        if(empty($_POST['email'])){
                   $emailErr = "<p> Please Enter Email</p>";
   
               }
               else{
                   if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                   $emailErr="<p>Invalid Email format</p>";
                }
        }
        if(empty($_POST['password'])){
            $passwordErr= "<p>Please Enter Password</p>";
        }
        elseif(strlen($_POST['password'])<8){
            $passwordErr="The Password must contain atleast 8 characters";
        }
        if(empty($_POST['cpassword'])){
            $cpasswordErr = "<p>Please Retype your Password </p>";
        }
        else{
            if($_POST['password'] != $_POST['cpassword']){
                $cpasswordErr = "<p> Password Do not Match</p>";
            }
        }
        $name = validate_data(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
        $email = validate_data(filter_var(filter_var($_POST["email"],FILTER_SANITIZE_EMAIL),FILTER_VALIDATE_EMAIL));
        $pwd = validate_data(filter_var($_POST["password"],FILTER_SANITIZE_STRING));
        $hash= password_hash($pwd, PASSWORD_DEFAULT);
        include 'dbcon.php';
        $existSql="SELECT * FROM RESTAURANTS WHERE email = '$email'";
        $check = mysqli_query($con, $existSql);
        if(mysqli_num_rows($check)>0){
            $emailErr="This Email Adrress is Already Registered please login";
        } 

        /**
         * checking if there are no errors 
         */

        if($nameErr == "" && $emailErr == "" && $passwordErr == "" && $cpasswordErr == ""){
            
     
   
           
            $sql = "INSERT INTO restaurants (name, email, password, created_at) VALUES ('$name', '$email', '$hash', current_timestamp())"; 
           
           $result = mysqli_query($con, $sql);
            if($result){
             $success=true;
            $name="";
            $email="";
            $password="";
            $cpassword="";
            }
            else{
                die(mysqli_error($con));
                $showError=true;
            }
            
        }
    }

    function validate_data($data) {
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
    <?php include 'nav.php' ?>
    <?php
   
        if(isset($success)){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Your Account is created </strong> Now You can login to your account
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';
        }
        if(isset($showError)){
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Something went wrong </strong> Please Try again
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';
        }
        
    ?>
    <div class="container">

        <div class="container-card">

            <div class="card">
                <h5 class="card-header">Register Your Restaurant With Us</h5>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <div class="form-group">
                            <label for="name">Name of Restaurant</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Restaurant" value="<?php echo $name?>">
                            <span class="text-danger"><?php echo $nameErr ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email ?>">
                            <span class="text-danger"><?php echo $emailErr ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                            <span class="text-danger"><?php echo $passwordErr ?></span>
                        </div>

                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword">
                            <span class="text-danger"><?php echo $cpasswordErr ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
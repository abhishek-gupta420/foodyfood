<?php
session_start();
$emailErr = $passwordErr = "";
$email = $password = "";

if (isset($_SESSION['loggedin'])) {
    $_SESSION['msg']="You are Already Logged IN";
    header('location:index.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //calling dbcon (database file)


    if (empty($_POST['email'])) {
        $emailErr = "<p> Please Enter Email</p>";
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<p>Invalid Email format</p>";
        }
    }
    if (empty($_POST['password'])) {
        $passwordErr = "<p>Please Enter Password</p>";
    }


    $email = validate_data(filter_var(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL));
    $pwd = validate_data(filter_var($_POST["password"], FILTER_SANITIZE_STRING));

    /**
     * checking if there are no errors 
     */

    if ($emailErr == "" && $passwordErr == "") {

        include 'dbcon.php';


        $sql = "Select * from customers where email='$email'";

        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($pwd, $row['password'])) {
                    $login = true;

                    session_start();

                 
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['c_id'] = $row['id'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['mobile'] = $row['mobile'];
                    $_SESSION['clogin'] = true;
                    $_SESSION['pre'] = $row['preference'];
                    $_SESSION['msg']= "You are Logged IN Now You can place your orders";

                    header("location:index.php");
                }else{
                    $passwordErr="password not matched";
                }
            
            
        } else {
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
    <?php include 'nav.php' ?>
    <?php
    include 'msg.php';
    if (isset($loggedin)==true) {
        
        $_SESSION['msg']="you are already logged in";
        header("location: index.php");
    }
    ?>
    <div class="container">

        <div class="container-card">

            <div class="card" style="width: 50%;margin-top: 100px;">
                <h5 class="card-header">Customer's Login</h5>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

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



                        <button type="submit" class="btn btn-primary">Login</button>
                        
                        Do not have account ? - <a href="cregister.php">Register</a>
                       
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
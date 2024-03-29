<?php
session_start();
$emailErr = $passwordErr = "";
$email = $password = "";

if (isset($_SESSION['loggedin'])) {
    $_SESSION['msg']="You are Already Logged IN";
    header('location:resdashboard.php');
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


        $sql = "Select * from restaurants where email='$email'";

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
                    $_SESSION['res_id'] = $row['id'];
                    $_SESSION['reslogin'] = true;
                    
                    $_SESSION['msg']="Welcome ".$_SESSION['name'];

                    header("location:resdashboard.php");
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

    if (isset($login)) {
        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your Account is created </strong> Now You can login to your account
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>';
    }
    if (isset($showError)) {
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>You are not valid user</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';
    }

    ?>
    <div class="container">

        <div class="container-card">

            <div class="card" style="width: 50%;margin-top: 100px;">
                <h5 class="card-header">Restaurant's Login</h5>
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
                        Do not have account ? - <a href="resreg.php">Register</a>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
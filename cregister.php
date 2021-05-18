<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    $_SESSION['msg']="You are Already Logged IN";
    header('location:index.php');
}
$nameErr = $emailErr = $passwordErr = $cpasswordErr = $mobileErr = $addressErr = $pErr = "";
$name = $email = $password = $cpassword = $preference = $address = $mobile = "";

//adding validation to receive fruitful data only


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //calling dbcon (database file)
    if (empty($_POST['name'])) {
        $nameErr = "<p> Please Enter Name </p>";
    }

    if (empty($_POST['email'])) {
        $emailErr = "<p> Please Enter Email</p>";
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<p>Invalid Email format</p>";
        }
    }
    if (empty($_POST['password'])) {
        $passwordErr = "<p>Please Enter Password</p>";
    } elseif (strlen($_POST['password']) < 8) {
        $passwordErr = "The Password must contain atleast 8 characters";
    }
    if (empty($_POST['cpassword'])) {
        $cpasswordErr = "<p>Please Retype your Password </p>";
    } else {
        if ($_POST['password'] != $_POST['cpassword']) {
            $cpasswordErr = "<p> Password Do not Match</p>";
        }
    }
    if (empty($_POST['address'])) {
        $addressErr = "Please enter your Address";
    }

    if (empty($_POST['mobile'])) {
        $mobileErr = "Please Enter your Mobile Number";
    } elseif (!preg_match("/^[6-9][0-9]{9}$/", $_POST['mobile'])) {
        $mobileErr = "Invalid Mobile number";
    }

    // preference validation
    
    if (!isset($preference)) {
        $pErr = "Please select one preference";
    }

    $name = validate_data(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = validate_data(filter_var(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL));
    $pwd = validate_data(filter_var($_POST["password"], FILTER_SANITIZE_STRING));
    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    $address = validate_data(filter_var($_POST['address'], FILTER_SANITIZE_STRING));
    $mobile = validate_data(filter_var($_POST['mobile'], FILTER_SANITIZE_STRING));
    if(isset($_POST['preference'])){
    $preference=$_POST['preference'];
    }
    //calling dbcon file

    include 'dbcon.php';

    //checking the unique constraint for the email id
    $existSql = "SELECT * FROM customers WHERE email = '$email'";
    $check = mysqli_query($con, $existSql);
    if (mysqli_num_rows($check) > 0) {
        $emailErr = "This Email Adrress is Already Registered please login";
    }

    /**
     * checking if there are no errors 
     */

    if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $cpasswordErr == "" && $mobileErr == "" && $addressErr == "" && $pErr == "") {




        $sql = "INSERT INTO customers (name, email, password, address, mobile, preference, created_at) VALUES ('$name', '$email', '$hash', '$address', '$mobile', '$preference', current_timestamp())";

        $result = mysqli_query($con, $sql);
        if ($result) {
            $success = true;
            $name = "";
            $email = "";
            $password = "";
            $cpassword = "";
            $address = "";
            $mobile = "";
            $preference = "";
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
    <?php include 'nav.php' ?>
    <?php

    if (isset($success)) {
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
                    <strong>Something went wrong </strong> Please Try again
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';
    }

    ?>
    <div class="container">

        <div class="container-card">

            <div class="card" style="width: 100%;">
                <h5 class="card-header">Register Customer</h5>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Enter Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name " value="<?php echo $name ?>">
                                <span class="text-danger"><?php echo $nameErr ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email ?>">
                                <span class="text-danger"><?php echo $emailErr ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                <span class="text-danger"><?php echo $passwordErr ?></span>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword">
                                <span class="text-danger"><?php echo $cpasswordErr ?></span>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $address ?>">
                                <span class="text-danger"><?php echo $addressErr ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your Mobile number" value="<?php echo $mobile ?>">
                                <span class="text-danger"><?php echo $mobileErr ?></span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="preference">Select Your Preference</label><br>
                            Veg <input type="radio" id="preference" name="preference" value="veg">
                            Non-Veg<input type="radio" id="preference" name="preference" value="nonveg">
                            <span class="text-danger"><?php echo $pErr ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
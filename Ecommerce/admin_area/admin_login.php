<?php
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    @session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font awesome linl -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .img-fluid {
            width: 300px;
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-x1-4">
                <img src="../images/fills-in-the-profile-data-form-businessman-fills-in-the-profile-data-form-free-png.webp" alt="admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-2 col-x1-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter your username" required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Do you have an account? <a href="admin_registration.php" class="link-danger">Registration</a></p>
                    </div>
                    <div>
                        <a href="../users_area/user_login.php">Costumer Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 

    if(isset($_POST['admin_login'])) {
        $admin_name = $_POST['admin_name'];
        $admin_password = $_POST['admin_password'];

        $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
        $result = mysqli_query($con, $select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);

        if($row_count>0) {
            $_SESSION['admin_name'] = $admin_name;
            if(password_verify($admin_password, $row_data['admin_password'])) {
                //echo "<script>alert('Login successful')</script>";
                if($row_count == 1) {
                    $_SESSION['admin_name'] = $admin_name;
                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                } 
            } else {
                echo "<script>alert('Invalid Credentials')</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    }

?>
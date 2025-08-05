<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Font awesome linl -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
     <link rel="stylesheet" href="../style.css">
     <style>
        .admin_image {
            width: 100px;
            object-fit: contain;
        }
        .footer {
            position: absolute;
            bottom: 0;;
        }
        body{
            overflow-x: hidden;
        }
        .product_img{
            width: 100px;
            object-fit: contain;
        } 
     </style>
</head>
<body>
    
    <!-- navbar -->
     <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/pngwing.com.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
         <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
         </div>

         <!-- third child -->
          <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-5">
                    <a href="#"><img src="https://organicmandya.com/cdn/shop/files/Pineapple.jpg?v=1721375225&width=1000" alt="" class="admin_image">
                        <?php
                        if(isset($_SESSION['admin_name'])) {
                            echo "
                            <a class='nav-link'>Welcome ".$_SESSION['admin_name']."</a>
                            ";
                        }
                    ?>
                    </a>
                </div>
                <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
                <div class="button text-center">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">View Categories</a></button>
                    <button><a href="index.php?insert_brands" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">View Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                    <button><a href="index.php?list_payments" class="nav-link text-light bg-info my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                    <button><a href="index.php?logout" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
          </div>

          <!-- Fourth child -->
           <div class="container my-3">
            <?php 
            if(isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brands'])) {
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if(isset($_GET['edit_brands'])) {
                include('edit_brands.php');
            }
            if(isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            if(isset($_GET['delete_brands'])) {
                include('delete_brands.php');
            }
            if(isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if(isset($_GET['list_payments'])) {
                include('list_payments.php');
            }
            if(isset($_GET['list_users'])) {
                include('list_users.php');
            }
            if(isset($_GET['logout'])) {
                session_start();
                session_unset();
                session_destroy();
                echo "<script>window.open('admin_login.php','_self')</script>";
            }
            ?>
           </div>
           <!-- last child -->
            <!-- include footer -->
             <?php include("../includes/footer.php") ?>
     </div>

<!-- Bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>
</html>
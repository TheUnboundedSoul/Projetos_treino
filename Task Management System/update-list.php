<?php 

    include('config/constants.php'); 

    //GET the Current Values of Selected List
    if(isset($_GET['list_id'])) {
        //Get the List ID value
        $list_id = $_GET['list_id'];
        
        //Connect to Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //Query to Get the Values from Database
        $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true){
            //Get the Value from Database
            $row = mysqli_fetch_assoc($res); //Value is in array

            //Create Indiviual Variables to dave the data
            $list_name = $row['list_name'];
            $list_description = $row['list_description'];
        } else {
            // Go Back to Manage Lists
            header('location:'.SITEURL.'manage-list.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>

    <div class="menu">
        <a class="btn-primary" href="<?php echo SITEURL; ?>">Home</a>
        <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>

    <h3>Update List Page</h3>

    <p>
        <?php
            //Check whether the session is set or not
            if(isset($_SESSION['update_fail'])) {
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>

    <form method="post" action="">
        <table class="tbl-full">
            <tr>
                <td>List Name: </td>
                <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
            </tr>
            <tr>
                <td>List Description: </td>
                <td>
                    <textarea name="list_description">
                        <?php echo $list_description; ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td><input class="btn-secondary" type="submit" name="submit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php

    //Check whether the Update is Clicked or Not
    if(isset($_POST['submit'])) {
        //Get the Updated Values from our Form
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        //Connect Database
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //Select the Database
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        //Query to Update List
        $sql2 = "UPDATE tbl_lists SET list_name = '$list_name', list_description='$list_description' WHERE list_id=$list_id";

        //Execute the Query
        $res2 = mysqli_query($conn2, $sql2);

        //Check whether the query executed successfully or Not
        if($res2 == true) {
            //Update Successful
            //Set the Message
            $_SESSION['update'] = "List Updated Sucessfully";

            //Redirect to Manage List Page
            header('location:'.SITEURL.'manage-list.php');
        } else {
            //Failed to Update
            //Set Session Message
            $_SESSION['update_fail'] = "Failed to Update List";

            //Redirect to  the update 
            header('location'.SITEURL.'update-list.php?list_id='.$list_id);
        }
    }

?>
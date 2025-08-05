<?php
    include('config/constants.php');
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
    <a href="<?php echo SITEURL; ?>">Home</a>
    <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
        <?php 
            //Check whether the session is created or not
            if(isset($_SESSION['add_fail'])) {
                //display session message
                echo $_SESSION['add_fail'];
                //Remove the message after displaying once
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>

    <!-- Form to Add Lsit Starts here -->
    <form method="post" action="">
        <table>
            <tr>
                <td>List Name: </td>
                <td><input type="text" name="list_name" placeholder="Type List Name Here" required="required"></td>
            </tr>
            <tr>
                <td>List Description: </td>
                <td><textarea name="list_description" placeholder="Type List Description Here" required="required"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="SAVE"></td>
            </tr>
        </table>
    </form>
    <!-- Form to Add Lsit Ends here -->
    </div>
</body>
</html>

<?php

    //Check whether the form is submitted or not
    if(isset($_POST['submit'])) {
        //echo "Form Submitted";

        //Get the values from form and save it in website
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        
        //Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //Check whether the database connected or not
        /*
        if($conn == true) {
            echo "Database Connected";
        }
        */

        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME);

        //Check whether database is connected or not
        /*
        if($db_select == true) {
            echo "Database Selected";
        }
        */
        //SQL Query to Insert data into database
        $sql = "INSERT INTO tbl_lists SET 
            list_name = '$list_name', 
            list_description = '$list_description'";

        //Execute Query and Insert into Database
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfull or not
        if($res==true) {
            //Data inserted successfully
            //echo "Data Inserted";

            //Create a SESSION Variable to Display message
            $_SESSION['add'] = "List Added Successfully";

            //Redirect to Manage List Page
            header('location:'.SITEURL.'manage-list.php');

        } else {
            //Failed inserted successfully
            echo "Failed to Insert Data";

            //Create a SESSION Variable to Save message
            $_SESSION['add_fail'] = "Failed to Add List";

            //Redirect to Same Page
            header('location:'.SITEURL.'add-list.php');
        }
    } 

?>
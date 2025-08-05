<?php

//Include constants.php
include('config/constants.php');

//Check whether the list_id is assigned or not

if(isset($_GET['list_id'])) {
    //Delete the List from database

    //Get the list_id value from URL or Get Method
    $list_id = $_GET['list_id'];

    //Connect the Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //Select Database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    //Write the Query to DELETE List from Database
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

    //Execite the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true) {
        //Query Exectued Successfully which means list is deleted successfully
        $_SESSION['delete'] = "List Deleted Succssfully";

        //Redirect to Manage List Page
        header('location:'.SITEURL.'manage-list.php');
    } else {
        //Failed to delete list
        $_SESSION['delete_fail'] = "Failed to Delete List.";
        header('location'.SITEURL.'manage-list.php');
    }
} else {
    //Redirect to Manage List Page
    header('location:'.SITEURL.'manage-list.php');
}

?>
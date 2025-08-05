<?php 

include('config/constants.php');

//Check the Task ID in URL;

if(isset($_GET['task_id'])) {
    //Get the Values from Database
    $task_id = $_GET['task_id'];

    //Connect Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //Select Database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    //SQL Query to Get the detail of selected task
    $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

    //Execute Query
    $res = mysqli_query($conn, $sql);

    //Check if the query executed successfully or not
    if($res==true) {
        //Query 
        $row = mysqli_fetch_assoc($res);

        //get the Individual Value
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    }
} else {
    //Redirect to Homepage
    header('location:'.SITEURL);
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

    <p>
        <a class="btn-primary" href="<?php echo SITEURL; ?>">Home</a>
    </p>

    <h3>Update Task Page</h3>

    <p>
        <?php
            if(isset($_SESSION['update_fail'])) {
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>

    <form method="POST" action="">
        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required"></td>
            </tr>
            <tr>
                <td>Task Description: </td>
                <td>
                    <textarea name="task_description">
                        <?php echo $task_description; ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id">
                        <?php
                            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                            //SELECT DATABASE
                            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

                            //SQL Query to GET Lists
                            $sql2 = "SELECT * FROM tbl_lists";

                            //Execute Query
                            $res2 = mysqli_query($conn2, $sql2);

                            //Check if executed successfully or not
                            if($res2==true) {
                                //Display the Lists
                                //Count Rows
                                $count_rows2 = mysqli_num_rows($res2);

                                //Check whether list is added or not
                                if($count_rows2>0) {
                                    //Lists are added
                                    while($row2=mysqli_fetch_assoc($res2))  {
                                        //Get individual value
                                        $list_id_db = $row2['list_id'];
                                        $list_name = $row2['list_name'];
                                        ?>
                                        <option <?php if($list_id_db==$list_id) {echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                        <?php
                                    }
                                } else {
                                    //No list added
                                    ?>
                                    <option value="<?php if($list_id=0) {echo "selected='selected'";} ?>">None</option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority">
                        <option <?php if($priority=="High"){echo "selected='selected'";} ?>value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";}?> value="Medium">Medium</option>
                        <option <?php if($priority=="Low"){echo "selected='selected'";}?> value="Low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline" value="<?php echo $deadline ?>"></td>
            </tr>
            <tr>
                <td>
                    <input class="btn-secondary" type="submit" name="submit" value="UPDATE">
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php

if(isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    //Connect Database
    $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //Select Database
    $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());

    //Create SQL Query to Update Task
    $sql3 = "UPDATE tbl_tasks SET task_name='$task_name', task_description='$task_description', list_id='$list_id', priority='$priority', deadline='$deadline' WHERE task_id=$task_id";

    //Execute Query
    $res3 = mysqli_query($conn3, $sql3);

    //Check whether the Query Executed or Not
    if($res3==true) {
        //Query Executed and Task Updated
        $_SESSION['update'] = "Task Update Successfully";

        //Redirect to Home Page
        header('location:'.SITEURL);
    } else {
        //Failed to Update Task
        $_SESSION['update_fail'] = "Failed to Update Task";

        //Redirect to this Page
        header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
    }
}

?>
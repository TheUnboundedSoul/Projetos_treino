<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php

        $username = $_SESSION['username'];
        $get_user = "Select * from `user_table` WHERE username='$username'";
        $result = mysqli_query($con, $get_user);
        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $row_fetch['user_id'];


    ?>
    <h3 class="text-success">All My Orders</h3>
    <table class="table-bordered mt-5">
        <thead class="bg-info">
        <tr>
            <th>Sl no</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $get_order_details = "Select * from `user_orders` WHERE user_id=$user_id";
                $result_orders = mysqli_query($con, $get_order_details);
                while($row_orders = mysqli_fetch_assoc(($result_orders))) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $total_products = $row_orders['total_products'];
                    $invoice_number = $row_orders['invoice_number'];
                    $order_status = $row_orders['order_status'];
                    if($order_status == 'pending'){
                        $order_status = 'Incomplete';
                    } else {
                        $order_status = 'Complete';
                    }
                    $order_date = $row_orders['order_date'];
                    $number = 1;
                    echo "
                    <tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                        ?>
                        <?php
                        if ($order_status == 'Complete') {
                            echo "
                                <td>Paid</td>
                            </tr>
                            ";
                        }else {
                            echo "
                                <td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                            </tr>
                            ";
                        }
                        
                    $number++;
                }
            ?>
        </tbody>
    </table>
</body>
</html>
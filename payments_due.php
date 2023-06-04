<?php
session_start();
if($_SESSION['Login']!="Active")
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer-Login</title>
    <?php include('links.php'); ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 p-0 bg-dark">
                <?php include('customer_navigation.html'); ?>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 p-0">
                <?php include('customer_contain_login.html'); ?>
                <div class="container-fluid p-3">
                    <div class="card m-0">
                        <div class="card-header bg-dark text-white">
                            <p class="h2">Customer Payments Due</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>TransactionID</th>
                                    <th>Amount Paid</th>
                                    <!-- <th>Amount Left</th> -->
                                    <th>Trasaction Date</th>
                                </tr>
                                <?php
                                    $conn = mysqli_connect("localhost","root","","WholeSale_Management");
                                    $sql = "SELECT TransactionID, Amount_Paid, Transaction_Date FROM Payment";
                                    $result = mysqli_query($conn,$sql);

                                    $row = mysqli_fetch_assoc($result);
                                    do { ?>
                                <tr>
                                    <td><?php echo $row['TransactionID']; ?></td>
                                    <td><?php echo $row['Amount_Paid']; ?></td>
                                    <!-- <td><?php echo $row['Amount_Left']; ?></td> -->
                                    <td><?php echo $row['Transaction_Date']; ?></td>
                                </tr>
                                <?php } while($row = mysqli_fetch_assoc($result)) ?>
                                <tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>
</body>

</html>
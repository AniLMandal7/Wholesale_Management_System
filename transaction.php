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
                        <form action="transaction.php" method="POST">
                            <div class="card-header bg-dark text-white">
                                <p class="h2">From Date to To Date Transactions</p>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 mt-3">
                                    <label for="FDate"><strong>From Date</strong></label>
                                    <input type="date" class="form-control" name="FDate" id="FDate"
                                        placeholder="Start Date" required />
                                </div>
                                <div class="mb-3">
                                    <label for="TDate">To Date</label>
                                    <input type="Date" class="form-control" name="TDate" id="TDate"
                                        placeholder="Login ID" required />
                                </div>

                            </div>
                            <div class="card-footer">
                                <input type="submit" name="Show" class="btn btn-success" value="Show Transactions" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container-fluid p-3">
                    <?php
						if(isset($_POST['Show']))
						{
						$fdate = $_POST['FDate'];
						$tdate = $_POST['TDate'];
					?>
                    <div class="card p-0">
                        <div class="card-header bg-dark text-white">
                            <p class="h2">Customer Transactions</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>Transaction_ID</th>
                                    <th>Product_ID</th>
                                    <th>Total_Amount</th>
                                    <th>Transaction_Date</th>
                                </tr>

                                <?php

									$conn1 = mysqli_connect("localhost","root","","WholeSale_Management");
									$CID = $_SESSION['CID'];
									$sql = "SELECT transaction_detail.TransactionID AS t1,transaction_detail.ProductID AS t2,transaction_detail.Total_Amount AS t3,transaction_detail.Trans_Init_Date AS t4
									FROM transaction_detail , transaction_information
									WHERE  transaction_information.CustomerID = '$CID'
									AND transaction_detail.TransactionID = transaction_information.TransactionID
									AND transaction_detail.Trans_Init_Date>='$fdate'
									AND transaction_detail.Trans_Init_Date<='$tdate'  ";
									$result = mysqli_query($conn1,$sql);
									$row = mysqli_fetch_assoc($result);
									do { 
								?>
                                <tr>
                                    <td><?php echo $row['t1']; ?></td>
                                    <td><?php echo $row['t2']; ?></td>
                                    <td><?php echo $row['t3']; ?></td>
                                    <td><?php echo $row['t4']; ?></td>
                                </tr>
                                <?php } while($row = mysqli_fetch_assoc($result)); ?>
                            </table>
                        </div>
                        <div class="card-footer">
                            <?php
							$conn = mysqli_connect("localhost","root","","WholeSale_Management");
							$sql = $sql = "SELECT SUM(transaction_detail.Total_Amount) AS t6
							FROM transaction_detail, transaction_information
							WHERE  transaction_information.CustomerID = '$CID'
							AND transaction_detail.TransactionID = transaction_information.TransactionID
							AND transaction_detail.Trans_Init_Date>='$fdate'
							AND transaction_detail.Trans_Init_Date<='$tdate'";

							$result1 = mysqli_query($conn,$sql);
							$row = mysqli_fetch_assoc($result1);
						?>
                            The Total Amount you Spent from <?php echo $fdate;  ?> to <?php echo $tdate; ?> is
                            <?php echo $row['t6']; ?>

                        </div>
                    </div>
                    <?php } ?>

                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>
</body>

</html>
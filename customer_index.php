<?php
session_start();
if($_SESSION['Login']!="Active")
{
   header("location:loginPage.php");
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
            <div class="col-sm-12 col-md-4 col-lg-3 p-0 bg-dark" style="height: 780px;">
                <?php include('customer_navigation.html'); ?>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 p-0" style="height: 780px;">
                <?php include('customer_contain_login.html'); ?>
                <div class="container-fluid bg-success text-white">
                    <?php
						$ci = $_SESSION['CID'];

						$conn = mysqli_connect("localhost","root","","WholeSale_Management");
						$sql = "SELECT Name  FROM customer_information
						WHERE  CustomerID = '$ci' ";
						$result = mysqli_query($conn,$sql);

						$row1 = mysqli_fetch_assoc($result);
						?>
                    <p class="display-3">Welcome <?php echo $row1['Name']; ?> </p>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>
</body>

</html>
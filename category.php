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
                            <p class="h2">Categories of products</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>CategoryID</th>
                                    <th>CategoryName</th>
                                </tr>
                                <?php
								$conn = mysqli_connect("localhost","root","","WholeSale_Management");
								$sql = "SELECT * FROM category";
								$result = mysqli_query($conn,$sql);

								$row = mysqli_fetch_assoc($result);
								do { ?>


                                <tr>
                                    <td><?php echo $row['CategoryID']; ?></td>
                                    <td><?php echo $row['CategoryName']; ?></td>
                                </tr>
                                <?php } while($row = mysqli_fetch_assoc($result)); ?>
                                <tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-3">
                    <div class="card m-0">
                        <form action="category.php" method="POST">
                            <div class="card-header bg-dark text-white">
                                <p class="h2">Select Category</p>
                            </div>
                            <div class="card-body">
                                <label for="ID">Category ID</label>
                                <input type="text" class="form-control" name="CategoryID" id="ID"
                                    placeholder="Catagory ID" required />
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="pshow" class="btn btn-success" value="Show Products" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container-fluid p-3">
                    <?php if(isset($_POST['pshow'])) {
						$catagoryID = $_POST['CategoryID'];?>
                    <div class="card p-0">
                        <div class="card-header bg-dark text-white">
                            <p class="h2">Products Under CategoryID <?php echo $catagoryID; ?></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>CategoryID</th>
                                    <th>Pname</th>
                                    <th>ProductID</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>ReorderLevel</th>
                                </tr>
                                <?php
									$conn1 = mysqli_connect("localhost","root","","WholeSale_Management");
									$sql1 = "SELECT CategoryID,Pname,product.ProductID AS product,Quantity_in_stock,USP,ReorderLevel
									FROM product,price_list
									WHERE  CategoryID = '$catagoryID'
									AND price_list.ProductID = product.ProductID";
									$result = mysqli_query($conn1,$sql1);
									$row1 = mysqli_fetch_assoc($result);
									do { ?>


                                <tr>
                                    <td><?php echo $row1['CategoryID']; ?></td>
                                    <td><?php echo $row1['Pname']; ?></td>
                                    <td><?php echo $row1['product']; ?></td>
                                    <td><?php echo $row1['Quantity_in_stock']; ?></td>
                                    <td><?php echo $row1['USP']; ?></td>
                                    <td><?php echo $row1['ReorderLevel']; ?></td>
                                </tr>
                                <?php } while($row1 = mysqli_fetch_assoc($result)) ?>
                            </table>
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
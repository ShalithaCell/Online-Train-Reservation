<?php
include "sessionWorker.php";



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../resources/favicon-train.ico" />
    <title>BOOkit-Shopping Cart</title>

    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" type="text/css" href="../Style/style-custom.css">
    <link rel="stylesheet" type="text/css" href="../Style/style-custom-nav.css">
    <link rel="stylesheet" type="text/css" href="../Style/shopingcart.css">


<!--    <link rel="stylesheet" type="text/css" href="../Style/rules.css">-->


    <script src="../Script/jquery-3.3.1.min.js"></script>
    <script src="../Script/Header.js"></script>

    <!--mdb-->
    <script src="../ExternalResources/MDB/js/popper.min.js"></script>
    <link href="../ExternalResources/MDB/css/mdb.min.css" rel="stylesheet">


    <!--Boostrap-->
    <link href="../ExternalResources/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../ExternalResources/bootstrap-4.3.1/js/bootstrap.min.js"></script>


    <script>

        //Jquery function for load nevigation to page
        $(function () {
            $('#Header').html(getHeaderLG());
            $('#footerID').html(getFooter());
        });
    </script>
</head>

<body>
    <!--Navigation Bar -->
    <div id='Header'></div>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "trs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cartID,TrainID,TrainClass,SeatNO,UserID,price  FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "cartID: " . $row["cartID"]. " \n TrainID: " . $row["TrainID"]. "\n TrainClass" . $row["TrainClass"]. "\n SeatNO" . $row["SeatNO"]."\n UserID" . $row["UserID"]."\n price" . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!--Adding Products  to Shopping Cart

case "add":
	if(!empty($_POST["quantity"])) {
		$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
		$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
		
		if(!empty($_SESSION["cart_item"])) {
			if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($productByCode[0]["code"] == $k) {
							if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								$_SESSION["cart_item"][$k]["quantity"] = 0;
							}
							$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
						}
				}
			} else {
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
		} else {
			$_SESSION["cart_item"] = $itemArray;
		}
	}
    break; -->
    
    
<!--List Cart Items from the PHP Session-->
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<!--Removing or Clearing Cart Item-->
<?php
//case "remove":
//	if(!empty($_SESSION["cart_item"])) {
//		foreach($_SESSION["cart_item"] as $k => $v) {
//			if($_GET["code"] == $k)
//				unset($_SESSION["cart_item"][$k]);
//			if(empty($_SESSION["cart_item"]))
//				unset($_SESSION["cart_item"]);
//		}
//	}
//	break;
//case "empty":
//	unset($_SESSION["cart_item"]);
//        break;
//?>



 <!--Shoping cart -->
    
    <br><br><br>
        <div class="cotainer mt-5 mx-5" >
            <div class="row mt-5">
                <div class="container col-lg-9">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                            <table class="table table-hover">
                                <thead class="table-header">
                                    <tr>
                                        <th>Tickets</th>
                                        <th>Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#">  </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#">Train name </a></h4>
                                                <h5 class="media-heading"> by <a href="#">Station name</a></h5>
                                                <span>Train status: </span><span class="text-success"><strong>Available</strong></span>
                                            </div>
                                        </div></td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <input type="email" class="form-control" id="exampleInputEmail1" value="3">
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$4.87</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$14.61</strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                        </button></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#">  </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#">Train name</a></h4>
                                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                                <span>Train status: </span><span class="text-success">Available</span>
                                            </div>
                                        </div></td>
                                        <td class="col-md-1" style="text-align: center">
                                        <input type="email" class="form-control" id="exampleInputEmail1" value="2">
                                        </td>
                                        <td class="col-md-1 text-center"><strong>$4.99</strong></td>
                                        <td class="col-md-1 text-center"><strong>$9.98</strong></td>
                                        <td class="col-md-1">
                                            <div id="cart_checkout">

                                            </div>
                                        <button type="button" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove" id="delete"></span> Remove
                                        </button></td>
                                    </tr>                                  <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                        <button type="button" class="btn btn-default mb-5" style="width: 200px; height: 40px; text-align: center">
                                            <span class="glyphicon glyphicon-shopping-cart" ></span><i class="fas fa-angle-left"></i>  Continue booking
                                        </button></td>
                                        <td>
                                        <button type="button" class="btn btn-success " >
                                            Checkout <span class="glyphicon glyphicon-play"></span>
                                        </button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- /.col-lg-9-->
        <div class="col-lg-3">
            <div id="order-summary" class="box">
              <div class="box-header">
                <h3 class="mb-0">Booking summary</h3>
              
              <p class="text-muted">Discounts and additional costs are calculated based on the values you have entered.</p>
            </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Payment subtotal</td>
                      <th>$446.00</th>
                    </tr>
                    <tr>
                      <td>Discounts added</td>
                      <th>$10.00</th>
                    </tr>
                    <tr>
                      <td>Tax</td>
                      <th>$0.00</th>
                    </tr>
                    <tr class="total">
                      <td>Total</td>
                      <th>$456.00</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

    </div>
</div>
<!--checkout cart-->
<script>
cart_checkout();
function cart_checkout(){
    $.ajax({
        url : "logic.php",
        method : "POST",
        data : {cart_checkout: 1},
        success : function(data){
            $("cart_checkout").html(data);
        }
    }) 
}

$("body").delegate(".delete","click",function(event){
    event.preventDefault();
    var pid = $p.attr("delete_id");
    alert(pid);
})
$("body").delegate(".update","click",function(event){
    event.preventDefault();
    var pid = $p.attr("update_id");
    alert(pid);
})
</script>

        
        
<br><br><br><br>

    <footer id="footerID">

    </footer>

    <!--cannot read property 'addeventlistener' of null mdb
    - This is probably because the script is executed before the page loads. By placing the script at the bottom of the page, I circumvented the problem.
    -->
    <script src="../ExternalResources/MDB/js/mdb.min.js"></script>

</body>

<?php
if(isset($_SESSION)){
if(session_status() != PHP_SESSION_NONE){

if(!isset($_SESSION['UserID'])){
    ?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}
}else{
if($_SESSION['RoleID'] == '1' || $_SESSION['RoleID'] == '2'){
?> <script type="text/javascript">setTimeout(showAdminPanel, 500)</script> <?php
}else{
?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}

}
}else{
?> <script type="text/javascript">setTimeout(hideAdminPanel, 500)</script> <?php
}


?>

</html>
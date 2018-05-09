<?php
/*
Template Name: Order Form
*/
get_header(); 

?>

<form  method="post">
Name of item: <input type="text" name="name"> <br> <br>
Quantity: <input type="text" name="qnty"><br> <br>
Size: <input type="text" name="size"><br> <br>
Color: <input type="text" name="color"><br> <br>
Total Price: <input type="text" name="total" value="<?php echo $price*$_POST[qnty]; ?>"> <br><br>
<input type="submit" name="order_submit" value="Submit Order">
<input type="submit" name="order_more" value = "Order more">
</form>

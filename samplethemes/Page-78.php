<?php
/* Template Name: ContactForm  */
get_header();
global $wpdb;
if ($_POST) {
	$username=$wpdb->escape($_POST['name']);
	$email=$wpdb->escape($_POST['email']);
	$password=$wpdb->escape($_POST['password']);
	$confpass=$wpdb->escape($_POST['confpass']);
	$error=array();
	if (strpos($username,' ')!==FALSE) {
			$error['username_space']="Username has Space";
	}
	if (empty($username)) {
			$error['username_empty']="Username required";
	}
	if ($username_exists($username)) {
			$error['username_exists']="Username exists already";
	}
	if (!is_email($email)){
		$error['email_valid']="Email has no valid value";
	}
	if (email_exists($email)) {
			$error['email_exists']="Email exists already";
	}
	if (strcmp($password,$confpass)!==0) {
		$error['password']="Password didn not match";
	}
	if (count($error)==0){
		wp_create_user($username,$password,$email);
		echo "User Created Successfully";
		exit();
	} else {
		print_r($error);
	}
}
?>
<form method="post">
    Name: <input type="text" name="name" id="name"> <br> <br>
    Email: <input type="text" name="email" id="email"> <br> <br>
    Password: <input type="password" name="password" id="password"> <br> <br>
    Confirm Password: <input type="password" nmae="confpass" id="confpass"> <br> <br>
    <input type="submit">
</form>

<?php get_footer(); ?>
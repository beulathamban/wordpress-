<?php
/*
Template Name: Contact Form
*/
get_header(); 

?>

<form method="post">
Name: <input type="text" name="name">
Email: <input type="text" name="email">
Password: <input type="password" name="password">
Confirm Password: <input type="password" name="confpassword">
<input type="submit" name="submit">
</form>

<?php get_footer(); ?>
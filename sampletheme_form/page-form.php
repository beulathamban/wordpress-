<?php
/* Template Name: ContactForm  */
get_header();
?>
<form method="post">
    Name: <input type="text" name="name" id="name"> <br> <br>
    Email: <input type="text" name="email" id="email"> <br> <br>
    Password: <input type="password" name="password" id="password"> <br> <br>
    Confirm Password: <input type="password" name="confpass" id="confpass"> <br> <br>
    <input type="submit" name="submit">
</form>


<?php get_footer(); ?>
<?php
function sampletheme_script_enqueue() {
	/*wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )*/
	wp_enqueue_style('thamban', get_stylesheet_uri(), array(), '1.0.0', 'all');
	wp_enqueue_script('customjs',get_template_directory_uri().'/js/sampletheme.js',array(),'1.0.0',true);
}
/*add_action( string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1 )*/
add_action('wp_enqueue_scripts', 'sampletheme_script_enqueue');

function sampletheme_theme_setup() {
add_theme_support('menus');
register_nav_menu('primary','Header Navigation');
register_nav_menu('secondary','Footer Navigation');
}
add_action('init', 'sampletheme_theme_setup');//init or after_setup_theme

?>
<!--Form and data handling-->
<form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
    Name: <input type="text" name="name" >
    Email: <input type="text" name="email">
    <input type="submit">
</form>
<?php echo $_POST['name'], '     ' ,$_POST['email']; 
//connectivity
$dsn="mysql:dbname=wpdb";
$username="root";
$password="root";
try {
    $conn= new PDO($dsn,$username,$password);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo "connection failed:" . $e->getMessage();
    }
   $sql="insert into contactForm(Name, Email) values ('$_POST[name]','$_POST[email]')";
    
    if ($conn->query($sql) == TRUE) {
    echo "<br>New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn=null;
    ?>
<?php
function sampletheme_script_enqueue() {
	/*wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )*/
	wp_enqueue_style('thamban', get_stylesheet_uri(), array(), '1.0.0', 'all');
	wp_enqueue_script('customjs',get_template_directory_uri().'/js/sampletheme.js',array(),'1.0.0',true);
	//wp_enqueue_script('jquery');
	//wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
	//wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
}
/*add_action( string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1 )*/
add_action('wp_enqueue_scripts', 'sampletheme_script_enqueue');

function sampletheme_theme_setup() {
add_theme_support('menus');
register_nav_menu('primary','Primary Header Navigation');
register_nav_menu('secondary','Footer Navigation');
}
add_action('init', 'sampletheme_theme_setup');//init or after_setup_theme
//add_action( 'after_set_theme', 'create_user_validation' );
//function create_user_validation(){
//include 'contact-form.php';

//}
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));

// sidebar function
function sampletheme_widget_setup() {
	register_sidebar(
		array(
			'name'=>'Sidebar',
			'id'=> 'sidebar-1',
			'class' =>'custom',		
			'description'=>'Standard Sidebar',
			'before_widget'=>'<aside id="%1$s" class="widget %2$s">',
			'after_widget'=> '</aside>',
			'before_title'=> '<h1 class="widget-title">',
			'after_title' => '</h1>',
			)
		 );

}

add_action('widgets_init','sampletheme_widget_setup');

if (isset($_POST['submit'])) {
	global $wpdb;
	if ($_POST['password'] == $_POST['confpass']) {
	$data_array=array(
					'Username'=> $_POST['username'],
					'Email'=>$_POST['email'],
					'Password'=> $_POST['password']
					);
	$table_name='wp_contactform_entry';
	$rowResult=$wpdb->insert($table_name,$data_array,$format=NULL);
	if ($rowResult==1) {
		echo '<h1> form submitted successfully</h1>';
	} else {
		echo 'error in submission';
	}
}
	echo "passwords dont match";
	
}

/*global $wpdb;
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
}*/
?>
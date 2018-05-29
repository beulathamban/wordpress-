<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function awesome_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/awesome.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
	wp_enqueue_style('customslidejs','https://cdnjs.cloudflare.com/ajax/libs/slidesjs/3.0/jquery.slides.min.js');
	
}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/
function awesome_theme_setup() {
	
	add_theme_support('menus');
	
	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');
	
}

add_action('init', 'awesome_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5',array('search-form'));

/*
	==========================================
	 Sidebar function
	==========================================
*/
function awesome_widget_setup() {
	
	register_sidebar(
		array(	
			'name'	=> 'Sidebar',
			'id'	=> 'sidebar-1',
			'class'	=> 'custom',
			'description' => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);
	
}
add_action('widgets_init','awesome_widget_setup');

/*
	==========================================
	 Include Walker file
	==========================================
*/
require get_template_directory() . '/inc/walker.php';

/*
	==========================================
	 Head function
	==========================================
*/
function awesome_remove_version() {
	return '';
}
add_filter('the_generator', 'awesome_remove_version');

/*
	==========================================
	 Custom Post Type
	==========================================
*/
function awesome_custom_post_type (){
	
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Item',
		'all_items' => 'All Items',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('portfolio',$args);
}
add_action('init','awesome_custom_post_type');

function awesome_custom_taxonomies() {
	
	//add new taxonomy hierarchical
	$labels = array(
		'name' => 'Fields',
		'singular_name' => 'Field',
		'search_items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field:',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Work Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'field' )
	);
	
	register_taxonomy('field', array('portfolio'), $args);
	
	//add new taxonomy NOT hierarchical
	
	register_taxonomy('software', 'portfolio', array(
		'label' => 'Software',
		'rewrite' => array( 'slug' => 'software' ),
		'hierarchical' => false
	) );
	
}

add_action( 'init' , 'awesome_custom_taxonomies' );

/*
	==========================================
	Custom Term Function
	==========================================
*/

function awesome_get_terms( $postID, $term ){
	
	$terms_list = wp_get_post_terms($postID, $term); 
	$output = '';
					
	$i = 0;
	foreach( $terms_list as $term ){ $i++;
		if( $i > 1 ){ $output .= ', '; }
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
	}
	
	return $output;
	
}

// Custom Post types for Feature project on home page

     add_action('init', 'create_feature');

       function create_feature() {

         $feature_args = array(

            'labels' => array(

             'name' => __( 'Feature Project' ),

             'singular_name' => __( 'Feature Project' ),

             'add_new' => __( 'Add New Feature Project' ),
             'add_new_item' => __( 'Add New Feature Project' ),

             'edit_item' => __( 'Edit Feature Project' ),

             'new_item' => __( 'Add New Feature Project' ),

             'view_item' => __( 'View Feature Project' ),

             'search_items' => __( 'Search Feature Project' ),

             'not_found' => __( 'No feature project found' ),

             'not_found_in_trash' => __( 'No feature project found in trash' )

           ),

         'public' => true,

         'show_ui' => true,

         'capability_type' => 'post',

         'hierarchical' => false,

         'rewrite' => true,

         'menu_position' => 20,

         'supports' => array('title', 'editor', 'thumbnail')

       );

    register_post_type('feature',$feature_args);

  }

  add_filter("manage_feature_edit_columns", "feature_edit_columns");

 

  function feature_edit_columns($feature_columns){

     $feature_columns = array(

        "cb" => "<input type=\"checkbox\" />",

        "title" => "Title",

     );

    return $feature_columns;

  }

  //Add Meta Boxes

  //http://wp.tutsplus.com/tutorials/plugins/how-to-create-custom-wordpress-writemeta-boxes/

 

  add_action( 'add_meta_boxes', 'cd_meta_box_add' );

  function cd_meta_box_add()

  {

    add_meta_box( 'my-meta-box-id', 'Link to Project', 'cd_meta_box_cb', 'feature', 'normal', 'high' );

  }

 

  function cd_meta_box_cb( $post )

  {

    $url = get_post_meta($post->ID, 'url', true);

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>



    <p>

      <label for="url">Project url</label>

      <input type="text" name="url" id="url" value="<?php echo $url; ?>" style="width:350px" />

    </p>

 

    <?php 

  }

   

  add_action( 'save_post', 'cd_meta_box_save' );

  function cd_meta_box_save( $post_id )

  {

    // Bail if we're doing an auto save

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

 

    // if our nonce isn't there, or we can't verify it, bail

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

 

    // if our current user can't edit this post, bail

   if( !current_user_can( 'edit_post' ) ) return;

 

    // now we can actually save the data

    $allowed = array(

      'a' => array( // on allow a tags

        'href' => array() // and those anchors can only have href attribute

      )

    );

 

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['url'] ) )

      update_post_meta( $post_id, 'url', wp_kses( $_POST['url'], $allowed ) );

  }


global $wpdb;
if (isset($_POST['submit'])) {
	$username=$wpdb->escape($_POST['name']);
	$email=$wpdb->escape($_POST['email']);
	$password=$wpdb->escape($_POST['password']);
	$confpass=$wpdb->escape($_POST['confpass']);
	// echo $username, $email, $password, $confpass;
	$error=array();
	if (strpos($username,' ')!==FALSE) {
			$error['username_space']="Username has Space";
			//echo "username has space";
	}
	if (empty($username)) {
			$error['username_empty']="Username required";
			//echo "username required";
	}
	if (username_exists($username)) {
			$error['username_exists']="Username exists already";
			//echo "username exists already";
	}
	if (!is_email($email)){
		$error['email_valid']="Email has no valid value";
		//echo "email has no valid value";
	}
	if (email_exists($email)) {
			$error['email_exists']="Email exists already";
			//echo "email exists already";
	}
	if (strcmp($password,$confpass)!==0) {
		$error['password']="Password did not match";
		//echo " password did not match";
	}
	if (count($error)==0){
		wp_create_user($username,$password,$email);
		echo "User Created Successfully";
		
	} else {
		
	print_r($error);
	}
}






















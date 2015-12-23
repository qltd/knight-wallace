<?php
/**
 * knight_wallace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package knight_wallace
 */

if ( ! function_exists( 'knight_wallace_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function knight_wallace_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on knight_wallace, use a find and replace
	 * to change 'knight_wallace' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'knight_wallace', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'knight_wallace' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'knight_wallace_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // knight_wallace_setup
add_action( 'after_setup_theme', 'knight_wallace_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function knight_wallace_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'knight_wallace_content_width', 640 );
}
add_action( 'after_setup_theme', 'knight_wallace_content_width', 0 );


/**
 * Add Custom Post Types
 *
 * */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    //People
    register_post_type( 'person_kw_fellow',
        array(
            'labels' => array(
                'name' => __( 'Knight-Wallace Fellows' ),
                'singular_name' => __( 'Knight-Wallace Fellow' ),
                'add_new_item' => __('Add New Knight-Wallace Fellow'),
                'new_item' => __('New Knight-Wallace Fellow'), 
                'view_item' => __('View Knight-Wallace Fellow'),
                'edit_item' => __('Edit Knight-Wallace Fellow'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'rewrite' => array("slug" => "kw-fellow")
        )
    );
    register_post_type( 'person_livingston',
        array(
            'labels' => array(
                'name' => __( 'Livingston Award Winners and Finalists' ),
                'singular_name' => __( 'Livingston Winner or Finalist' ),
                'add_new_item' => __('Add New Livingston Winner or Finalist'),
                'new_item' => __('New Livingston Winner or Finalist'), 
                'view_item' => __('View Livingston Winner or Finalist'),
                'edit_item' => __('Edit Livingston Winner or Finalist'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'rewrite' => array("slug" => "livingston-award-winners-finalists")
        )
    );
    register_post_type( 'person_staff',
        array(
            'labels' => array(
                'name' => __( 'Wallace House Staff' ),
                'singular_name' => __( 'Wallace House Staff' ),
                'add_new_item' => __('Add New Wallace House Staff'),
                'new_item' => __('New Wallace House Staff'), 
                'view_item' => __('View Wallace House Staff'),
                'edit_item' => __('Edit Wallace House Staff'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'rewrite' => array("slug" => "wallace-house-staff")
        )
    );
    register_post_type( 'person_laj',
        array(
            'labels' => array(
                'name' => __( 'Livingston Award Judges' ),
                'singular_name' => __( 'Livingston Award Judge' ),
                'add_new_item' => __('Add New Livingston Award Judge'),
                'new_item' => __('New Livingston Award Judge'), 
                'view_item' => __('View Livingston Award Judge'),
                'edit_item' => __('Edit Livingston Award Judge'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'rewrite' => array("slug" => "livingston-award-judge")
        )
    );
    register_post_type( 'person_donor',
        array(
            'labels' => array(
                'name' => __( 'Donors' ),
                'singular_name' => __( 'Donor' ),
                'add_new_item' => __('Add New Donor'),
                'new_item' => __('New Donor'), 
                'view_item' => __('View Donor'),
                'edit_item' => __('Edit Donor'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'rewrite' => array("slug" => "donor")
        )
    );
    //Library
    register_post_type( 'library',
        array(
            'labels' => array(
                'name' => __( 'Library' ),
                'singular_name' => __( 'Library Item' ),
                'add_new_item' => __('Add New Library Item'),
                'new_item' => __('New Library Item'), 
                'view_item' => __('View Library Item'),
                'edit_item' => __('Edit Library Item'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail','revisions','editor'),
            'rewrite' => array("slug" => "library")
        )
    );
}

add_action( 'add_meta_boxes', 'add_person_kw_fellow_metaboxes' );//add custom fields for person_kw_fellow type
add_action( 'add_meta_boxes', 'add_person_livingston_metaboxes' );//add custom fields for Livingston Winner or Finalist
add_action( 'add_meta_boxes', 'add_person_staff' );//add custom fields for Wallace House Staff 
add_action( 'add_meta_boxes', 'add_person_laj' );//add custom fields for Livingston Award Judge 
add_action( 'add_meta_boxes', 'add_person_donor' );//add custom fields for Donors 
add_action( 'add_meta_boxes', 'add_library_metaboxes' );//add custom fields for Library Items 

function add_person_kw_fellow_metaboxes() {
    //each meta box is a custom field for our custom content type
    add_meta_box('kw_person_kw_fellow_first_name', 'First Name', 'kw_person_kw_fellow_first_name', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_fellow_last_name', 'Last Name', 'kw_person_kw_fellow_last_name', 'person_kw_fellow', 'normal', 'default');

    add_meta_box('kw_person_kw_photo', 'Photo', 'kw_person_kw_photo', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_photo_add', 'Additional Photo', 'kw_person_kw_photo_add', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio', 'Bio', 'kw_person_kw_bio', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio_private', 'Private Bio', 'kw_person_kw_bio_private', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_class_year', 'Class Year', 'kw_person_kw_class_year', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_study_pro_title', 'Study Project Title', 'kw_person_kw_study_pro_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_current_job_title', 'Current Job Title', 'kw_person_kw_current_job_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_aff', 'Affiliation', 'kw_person_kw_aff', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_lib', 'Library Item', 'kw_person_kw_lib', 'person_kw_fellow', 'normal', 'default');
}

function add_person_livingston_metaboxes() {
    add_meta_box('kw_person_liv_first_name', 'First Name', 'kw_person_liv_first_name', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_last_name', 'Last Name', 'kw_person_liv_last_name', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_age', 'Age When Award Was Won', 'kw_person_liv_age', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_type', 'Award Type', 'kw_person_liv_type', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_win', 'Winner, Co-Winner, or Finalist', 'kw_person_liv_win', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_quote', 'Winner Quote', 'kw_person_liv_quote', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_ass', 'Current Assignment', 'kw_person_liv_ass', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_lib', 'Library Item', 'kw_person_liv_lib', 'person_livingston', 'normal', 'default');
}

function add_person_staff() {
    add_meta_box('kw_person_staff_first_name', 'First Name', 'kw_person_staff_first_name', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_last_name', 'Last Name', 'kw_person_staff_last_name', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_title', 'Title', 'kw_person_staff_title', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_bio', 'Bio', 'kw_person_staff_bio', 'person_staff', 'normal', 'default');
}

function add_person_laj() {
    add_meta_box('kw_person_laj_first_name', 'First Name', 'kw_person_laj_first_name', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_last_name', 'Last Name', 'kw_person_laj_last_name', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_title', 'Job Title', 'kw_person_laj_title', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_aff', 'Affiliation', 'kw_person_laj_aff', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_photo', 'Photo', 'kw_person_laj_photo', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_nat', 'National or Regional Judge', 'kw_person_laj_nat', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_bio', 'Bio', 'kw_person_laj_bio', 'person_laj', 'normal', 'default');
}

function add_person_donor() {
    add_meta_box('kw_person_donor_name', 'Name', 'kw_person_donor_name', 'person_donor', 'normal', 'default');
    add_meta_box('kw_person_donor_description', 'Description', 'kw_person_donor_description', 'person_donor', 'normal', 'default');
}

//for Library Items
function add_library_metaboxes() {
    add_meta_box('library_item_type', 'Library Item Type', 'library_item_type', 'library', 'normal', 'default');
    add_meta_box('library_publisher', 'Publisher', 'library_publisher', 'library', 'normal', 'default');
    add_meta_box('library_url', 'URL', 'library_url', 'library', 'normal', 'default');
    add_meta_box('library_author', 'Author', 'library_author', 'library', 'normal', 'default');
}

//Fill Knight Wallace type custom fields with html
function kw_person_kw_fellow_first_name() {
    //pass in true for the noncename once per custom type
    generate_html_for_custom_field("kw_person_kw_fellow_first_name",true);
}

function kw_person_kw_fellow_last_name() {
    generate_html_for_custom_field("kw_person_kw_fellow_last_name");
}

function kw_person_kw_photo() {
    generate_html_for_custom_field("kw_person_kw_photo");
}

function kw_person_kw_photo_add() {
    generate_html_for_custom_field("kw_person_kw_photo_add");
}

function kw_person_kw_bio() {
    generate_html_for_custom_field("kw_person_kw_bio");
}

function kw_person_kw_bio_private() {
    generate_html_for_custom_field("kw_person_kw_bio_private");
}

function kw_person_kw_class_year() {
    generate_html_for_custom_field("kw_person_kw_class_year");
}

function kw_person_kw_study_pro_title() {
    generate_html_for_custom_field("kw_person_kw_study_pro_title");
}

function kw_person_kw_current_job_title() {
    generate_html_for_custom_field("kw_person_kw_current_job_title");
}

function kw_person_kw_aff() {
    generate_html_for_custom_field("kw_person_kw_aff");
}

function kw_person_kw_lib() {
    generate_html_for_custom_field("kw_person_kw_lib");
}

//Fill Livingstion Awards type custom fields with html
function kw_person_liv_first_name() {
    //pass in true for the noncename once per custom type
    generate_html_for_custom_field("kw_person_liv_first_name",true);
}

function kw_person_liv_last_name() {
    generate_html_for_custom_field("kw_person_liv_last_name");
}

function kw_person_liv_age() {
    generate_html_for_custom_field("kw_person_liv_age");
}

function kw_person_liv_type() {
    generate_html_for_custom_field("kw_person_liv_type");
}

function kw_person_liv_win() {
    generate_html_for_custom_field("kw_person_liv_win");
}

function kw_person_liv_quote() {
    generate_html_for_custom_field("kw_person_liv_quote");
}

function kw_person_liv_ass() {
    generate_html_for_custom_field("kw_person_liv_ass");
}

function kw_person_liv_lib() {
    generate_html_for_custom_field("kw_person_liv_lib");
}

//Fill Wallace House Staff custom fields with needed html
function kw_person_staff_first_name() {
    generate_html_for_custom_field("kw_person_staff_first_name",true);
}

function kw_person_staff_last_name() {
    generate_html_for_custom_field("kw_person_staff_last_name");
}

function kw_person_staff_title() {
    generate_html_for_custom_field("kw_person_staff_title");
}

function kw_person_staff_bio() {
    generate_html_for_custom_field("kw_person_staff_bio");
}

//Callback functions for Livingston Award Judges, filling custom fields with needed html
function kw_person_laj_first_name() {
    generate_html_for_custom_field("kw_person_laj_first_name",true);
}

function kw_person_laj_last_name() {
    generate_html_for_custom_field("kw_person_laj_last_name");
}

function kw_person_laj_title() {
    generate_html_for_custom_field("kw_person_laj_title");
}

function kw_person_laj_aff() {
    generate_html_for_custom_field("kw_person_laj_aff");
}

function kw_person_laj_photo() {
    generate_html_for_custom_field("kw_person_laj_photo");
}

function kw_person_laj_nat() {
    generate_html_for_custom_field("kw_person_laj_nat");
}

function kw_person_laj_bio() {
    generate_html_for_custom_field("kw_person_laj_bio");
}

//Fill in html for Donors
function kw_person_donor_name() {
    //must pass in true, at least once per custom post type
    generate_html_for_custom_field("kw_person_donor_name",true);
}

function kw_person_donor_description() {
    generate_html_for_custom_field("kw_person_donor_description");
}

//Library
function library_publisher() {
    generate_html_for_custom_field("library_publisher",true);
}

function library_url() {
    generate_html_for_custom_field("library_url");
}

function library_item_type(){
    $lib_item_types = array(
        'Article', 
        'Book',
        'Video',
        'Photojournalism',
        'Journal'
    );
    generate_select_box_for_custom_field("library_item_type",$lib_item_types);
}

function library_author() {
    generate_html_for_custom_field("library_author");
}

function generate_html_for_custom_field($name, $add_noncename=false){
    global $post;

    // Noncename needed to verify where the data originated
    if($add_noncename){
        //we don't need to add this hidden field every time this function is called
        echo '<input type="hidden" name="kwmeta_noncename" id="kwmeta_noncename" value="' . 
            wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    }

    // Get the location data if its already been entered
    $saved_data = get_post_meta($post->ID, "_{$name}", true);

    // Echo out the field (this is so, so dirty.)
    echo '<input type="text" name="_'.$name.'" value="' . $saved_data  . '" class="widefat" />';
}

function generate_select_box_for_custom_field($name,$options){
    global $post;

    // Get the location data if its already been entered
    $saved_data = get_post_meta($post->ID, "_{$name}", true);

    // Echo out the field (this is so, so dirty.)
    echo '<select name="_'.$name.'" class="widefat">';
    foreach($options as $option){
        echo '<option value="'.$option.'"';
        if($saved_data == $option){
            echo ' selected="selected"'; 
        }
        echo '>'.$option.'</option>';
    }
    echo '</select>';
}

//save data in our custom fields! 
function kw_save_events_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['kwmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    //Knight-Wallace Fellows Custom fields
    $events_meta['_kw_person_kw_fellow_first_name'] = !empty($_POST['_kw_person_kw_fellow_first_name']) ? $_POST['_kw_person_kw_fellow_first_name'] : null;
    $events_meta['_kw_person_kw_fellow_last_name'] = !empty($_POST['_kw_person_kw_fellow_last_name']) ? $_POST['_kw_person_kw_fellow_last_name'] : null;
    $events_meta['_kw_person_kw_photo'] = !empty($_POST['_kw_person_kw_photo']) ? $_POST['_kw_person_kw_photo'] : null;
    $events_meta['_kw_person_kw_photo_add'] = !empty($_POST['_kw_person_kw_photo_add']) ? $_POST['_kw_person_kw_photo_add'] : null;
    $events_meta['_kw_person_kw_bio'] = !empty($_POST['_kw_person_kw_bio']) ? $_POST['_kw_person_kw_bio'] : null;
    $events_meta['_kw_person_kw_bio_private'] = !empty($_POST['_kw_person_kw_bio_private']) ? $_POST['_kw_person_kw_bio_private'] : null;
    $events_meta['_kw_person_kw_class_year'] = !empty($_POST['_kw_person_kw_class_year']) ? $_POST['_kw_person_kw_class_year'] : null;
    $events_meta['_kw_person_kw_study_pro_title'] = !empty($_POST['_kw_person_kw_study_pro_title']) ? $_POST['_kw_person_kw_study_pro_title'] : null;
    $events_meta['_kw_person_kw_current_job_title'] = !empty($_POST['_kw_person_kw_current_job_title']) ? $_POST['_kw_person_kw_current_job_title'] : null;
    $events_meta['_kw_person_kw_aff'] = !empty($_POST['_kw_person_kw_aff']) ? $_POST['_kw_person_kw_aff'] : null;
    $events_meta['_kw_person_kw_lib'] = !empty($_POST['_kw_person_kw_lib']) ? $_POST['_kw_person_kw_lib'] : null;

    //Livingston Winners Custom Fields
    $events_meta['_kw_person_liv_first_name'] = !empty($_POST['_kw_person_liv_first_name']) ? $_POST['_kw_person_liv_first_name'] : null;
    $events_meta['_kw_person_liv_last_name'] = !empty($_POST['_kw_person_liv_last_name']) ? $_POST['_kw_person_liv_last_name'] : null;
    $events_meta['_kw_person_liv_age'] = !empty($_POST['_kw_person_liv_age']) ? $_POST['_kw_person_liv_age'] : null;
    $events_meta['_kw_person_liv_type'] = !empty($_POST['_kw_person_liv_type']) ? $_POST['_kw_person_liv_type'] : null;
    $events_meta['_kw_person_liv_win'] = !empty($_POST['_kw_person_liv_win']) ? $_POST['_kw_person_liv_win'] : null;
    $events_meta['_kw_person_liv_quote'] = !empty($_POST['_kw_person_liv_quote']) ? $_POST['_kw_person_liv_quote'] : null;
    $events_meta['_kw_person_liv_ass'] = !empty($_POST['_kw_person_liv_ass']) ? $_POST['_kw_person_liv_ass'] : null;
    $events_meta['_kw_person_liv_lib'] = !empty($_POST['_kw_person_liv_lib']) ? $_POST['_kw_person_liv_lib'] : null;

    //Wallace House Staff Custom Fields
    $events_meta['_kw_person_staff_first_name'] = !empty($_POST['_kw_person_staff_first_name']) ? $_POST['_kw_person_staff_first_name'] : null;
    $events_meta['_kw_person_staff_last_name'] = !empty($_POST['_kw_person_staff_last_name']) ? $_POST['_kw_person_staff_last_name'] : null;
    $events_meta['_kw_person_staff_title'] = !empty($_POST['_kw_person_staff_title']) ? $_POST['_kw_person_staff_title'] : null;
    $events_meta['_kw_person_staff_bio'] = !empty($_POST['_kw_person_staff_bio']) ? $_POST['_kw_person_staff_bio'] : null;

    //Livingston Award Judges Custom Fields
    $events_meta['_kw_person_laj_first_name'] = !empty($_POST['_kw_person_laj_first_name']) ? $_POST['_kw_person_laj_first_name'] : null;
    $events_meta['_kw_person_laj_last_name'] = !empty($_POST['_kw_person_laj_last_name']) ? $_POST['_kw_person_laj_last_name'] : null;
    $events_meta['_kw_person_laj_title'] = !empty($_POST['_kw_person_laj_title']) ? $_POST['_kw_person_laj_title'] : null;
    $events_meta['_kw_person_laj_aff'] = !empty($_POST['_kw_person_laj_aff']) ? $_POST['_kw_person_laj_aff'] : null;
    $events_meta['_kw_person_laj_photo'] = !empty($_POST['_kw_person_laj_photo']) ? $_POST['_kw_person_laj_photo'] : null;
    $events_meta['_kw_person_laj_nat'] = !empty($_POST['_kw_person_laj_nat']) ? $_POST['_kw_person_laj_nat'] : null;
    $events_meta['_kw_person_laj_bio'] = !empty($_POST['_kw_person_laj_bio']) ? $_POST['_kw_person_laj_bio'] : null;

    //Donors
    $events_meta['_kw_person_donor_name'] = !empty($_POST['_kw_person_donor_name']) ? $_POST['_kw_person_donor_name'] : null;
    $events_meta['_kw_person_donor_description'] = !empty($_POST['_kw_person_donor_description']) ? $_POST['_kw_person_donor_description'] : null;

    //Library Items
    $events_meta['_library_publisher'] = !empty($_POST['_library_publisher']) ? $_POST['_library_publisher'] : null;
    $events_meta['_library_url'] = !empty($_POST['_library_url']) ? $_POST['_library_url'] : null;
    $events_meta['_library_item_type'] = !empty($_POST['_library_item_type']) ? $_POST['_library_item_type'] : null;
    $events_meta['_library_author'] = !empty($_POST['_library_author']) ? $_POST['_library_author'] : null;

    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}

add_action('save_post', 'kw_save_events_meta', 1, 2); // save the custom fields


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function knight_wallace_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'knight_wallace' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'knight_wallace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function knight_wallace_scripts() {
    wp_enqueue_style( 'knight_wallace-style', get_stylesheet_uri() );

    wp_enqueue_script( 'knight_wallace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'knight_wallace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'knight_wallace_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

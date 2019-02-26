<?php
/**
 * knight_wallace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package knight_wallace
 */
if(!session_id()){
    session_start();
}

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

    /**
     * Full width SUpport
     */
    add_theme_support( 'align-wide' );

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
            'exclude_from_search' => true,
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
            'exclude_from_search' => true,
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
            'exclude_from_search' => true,
            'rewrite' => array("slug" => "wallace-house-staff")
        )
    );
    register_post_type( 'person_board_member',
        array(
            'labels' => array(
                'name' => __( 'Board Members' ),
                'singular_name' => __( 'Board Member' ),
                'add_new_item' => __('Add New Board Member'),
                'new_item' => __('New Board Member'),
                'view_item' => __('View Board Member'),
                'edit_item' => __('Edit Board Member'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'exclude_from_search' => true,
            'rewrite' => array("slug" => "board-member")
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
            'exclude_from_search' => true,
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
            'rewrite' => array("slug" => "library"),
            'taxonomies' => array('post_tag')
        )
    );
    //Home page featured content blocks
    register_post_type( 'homepage_fcb',
        array(
            'labels' => array(
                'name' => __( 'Homepage Featured Content Blocks' ),
                'singular_name' => __( 'Homepage Featured Content Block' ),
                'add_new_item' => __('Add New Homepage Featured Content Block'),
                'new_item' => __('New Homepage Featured Content Block'),
                'view_item' => __('View Homepage Featured Content Block'),
                'edit_item' => __('Edit Homepage Featured Content Block'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail','revisions','editor'),
            'exclude_from_search' => true,
            'rewrite' => array("slug" => "featured-content-block"),
        )
    );
    register_post_type( 'hero_content',
        array(
            'labels' => array(
                'name' => __( 'Hero Content' ),
                'singular_name' => __( 'Hero Content' ),
                'add_new_item' => __('Add New Hero Content'),
                'new_item' => __('New Hero Content'),
                'view_item' => __('View Hero Content'),
                'edit_item' => __('Edit Hero Content'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail','revisions','editor'),
            'exclude_from_search' => true,
            'rewrite' => array("slug" => "hero-content"),
        )
    );
    register_post_type( 'slider_content',
        array(
            'labels' => array(
                'name' => __( 'Slider Content' ),
                'singular_name' => __( 'Slider Content' ),
                'add_new_item' => __('Add New Slider Content'),
                'new_item' => __('New Slider Content'),
                'view_item' => __('View Slider Content'),
                'edit_item' => __('Edit Slider Content'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail','revisions','editor','page-attributes'),
            'exclude_from_search' => true,
            'rewrite' => array("slug" => "slider-content"),
        )
    );
}

add_action( 'add_meta_boxes', 'add_person_kw_fellow_metaboxes' );//add custom fields for person_kw_fellow type
add_action( 'add_meta_boxes', 'add_person_livingston_metaboxes' );//add custom fields for Livingston Winner or Finalist
add_action( 'add_meta_boxes', 'add_person_staff' );//add custom fields for Wallace House Staff
add_action( 'add_meta_boxes', 'add_person_board_member' );//add custom fields for Wallace House Staff
add_action( 'add_meta_boxes', 'add_person_laj' );//add custom fields for Livingston Award Judge
add_action( 'add_meta_boxes', 'add_person_donor' );//add custom fields for Donors
add_action( 'add_meta_boxes', 'add_library_metaboxes' );//add custom fields for Library Items
add_action( 'add_meta_boxes', 'add_homepage_fcb' );//add custom fields for Featured Content Block
add_action( 'add_meta_boxes', 'add_hero_content' );//add custom fields for Featured Content Block
add_action( 'add_meta_boxes', 'add_slider_content' );//add custom fields for Fellows Slider

function add_person_kw_fellow_metaboxes() {
    //each meta box is a custom field for our custom content type
    add_meta_box('kw_person_kw_fellow_first_name', 'First Name', 'kw_person_kw_fellow_first_name', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_fellow_last_name', 'Last Name', 'kw_person_kw_fellow_last_name', 'person_kw_fellow', 'normal', 'default');

    add_meta_box('kw_person_kw_photo_add', 'Additional Photo', 'kw_person_kw_photo_add', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio', 'Bio', 'kw_person_kw_bio', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio_private', 'Private Bio', 'kw_person_kw_bio_private', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_class_year', 'Class Year', 'kw_person_kw_class_year', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_study_pro_title', 'Study Project Title', 'kw_person_kw_study_pro_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_current_job_title', 'Job Title', 'kw_person_kw_current_job_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_aff', 'Affiliation', 'kw_person_kw_aff', 'person_kw_fellow', 'normal', 'default');
    //add_meta_box('kw_person_kw_lib', 'Library Item', 'kw_person_kw_lib', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_locator_current_job_title', 'Current Job Title', 'kw_person_kw_locator_current_job_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_current_aff', 'Current Affiliation', 'kw_person_kw_current_aff', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_special', 'Specialty', 'kw_person_kw_special', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_city', 'Current Location - City', 'kw_person_kw_city', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_state', 'Current Location - State (leave blank if outside USA)', 'kw_person_kw_state', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_country', 'Current Location - Country (leave blank if USA)', 'kw_person_kw_country', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_available_for', 'Available For (private)', 'kw_person_kw_available_for', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_additional_info', 'Additional Info (private)', 'kw_person_kw_additional_info', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_personal_email', 'Personal Email (private)', 'kw_person_kw_personal_email', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_personal_phone', 'Personal Phone (private)', 'kw_person_kw_personal_phone', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_personal_twitter', 'Personal Twitter Handle (private)', 'kw_person_kw_personal_twitter', 'person_kw_fellow', 'normal', 'default');
    //add_meta_box('kw_person_kw_prv', 'Display Alumni?', 'kw_person_kw_prv', 'person_kw_fellow', 'normal', 'default');
    //add_meta_box('kw_person_kw_username', 'WP Username', 'kw_person_kw_username', 'person_kw_fellow', 'normal', 'default');
}

function add_person_livingston_metaboxes() {
    add_meta_box('kw_person_liv_first_name', 'First Name', 'kw_person_liv_first_name', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_last_name', 'Last Name', 'kw_person_liv_last_name', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_age', 'Age When Award Was Won', 'kw_person_liv_age', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_year', 'Year Won', 'kw_person_liv_year', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_type', 'Award Type', 'kw_person_liv_type', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_win', 'Winner, Co-Winner, or Finalist', 'kw_person_liv_win', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_quote', 'Winner Quote', 'kw_person_liv_quote', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_win_aff', 'Winning Affiliation', 'kw_person_liv_win_aff', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_win_job', 'Winning Job Title', 'kw_person_liv_win_job', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_ass', 'Current Affiliation', 'kw_person_liv_ass', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_job', 'Current Job Title', 'kw_person_liv_job', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_lib', 'Library Item', 'kw_person_liv_lib', 'person_livingston', 'normal', 'default');
}

function add_person_staff() {
    add_meta_box('kw_person_staff_first_name', 'First Name', 'kw_person_staff_first_name', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_last_name', 'Last Name', 'kw_person_staff_last_name', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_title', 'Title', 'kw_person_staff_title', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_bio', 'Bio', 'kw_person_staff_bio', 'person_staff', 'normal', 'default');
    add_meta_box('kw_person_staff_order', 'Order', 'kw_person_staff_order', 'person_staff', 'normal', 'default');
}

function add_person_board_member() {
    add_meta_box('person_board_member_first_name', 'First Name', 'person_board_member_first_name', 'person_board_member', 'normal', 'default');
    add_meta_box('person_board_member_last_name', 'Last Name', 'person_board_member_last_name', 'person_board_member', 'normal', 'default');
    add_meta_box('person_board_member_title', 'Title', 'person_board_member_title', 'person_board_member', 'normal', 'default');
    add_meta_box('person_board_member_ass', 'Affiliation', 'person_board_member_ass', 'person_board_member', 'normal', 'default');
    add_meta_box('person_board_member_bio', 'Bio', 'person_board_member_bio', 'person_board_member', 'normal', 'default');
}

function add_person_laj() {
    add_meta_box('kw_person_laj_first_name', 'First Name', 'kw_person_laj_first_name', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_last_name', 'Last Name', 'kw_person_laj_last_name', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_title', 'Job Title', 'kw_person_laj_title', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_aff', 'Affiliation', 'kw_person_laj_aff', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_nat', 'National or Regional Judge', 'kw_person_laj_nat', 'person_laj', 'normal', 'default');
    add_meta_box('kw_person_laj_bio', 'Bio', 'kw_person_laj_bio', 'person_laj', 'normal', 'default');
}

function add_person_donor() {
    add_meta_box('kw_person_donor_name', 'Name', 'kw_person_donor_name', 'person_donor', 'normal', 'default');
    add_meta_box('kw_person_donor_description', 'Description', 'kw_person_donor_description', 'person_donor', 'normal', 'default');
    add_meta_box('kw_person_donor_type', 'Type', 'kw_person_donor_type', 'person_donor', 'normal', 'default');
}

//for Library Items
function add_library_metaboxes() {
    add_meta_box('library_item_type', 'Library Item Type', 'library_item_type', 'library', 'normal', 'default');
    add_meta_box('library_publisher', 'Publisher', 'library_publisher', 'library', 'normal', 'default');
    add_meta_box('library_url', 'URL', 'library_url', 'library', 'normal', 'default');
    add_meta_box('library_author', 'Author', 'library_author', 'library', 'normal', 'default');
    add_meta_box('library_featured', 'Featured', 'library_featured', 'library', 'normal', 'default');
}

//For Homepage Featured Content Blocks
function add_homepage_fcb(){
    add_meta_box('fcb_link', 'Link', 'fcb_link', 'homepage_fcb', 'normal', 'default');
    add_meta_box('fcb_which_page', 'Choose Page', 'fcb_which_page', 'homepage_fcb', 'normal', 'default');
}

//Hero Content
function add_hero_content(){
    add_meta_box('hero_content_link', 'Link', 'hero_content_link', 'hero_content', 'normal', 'default');
    add_meta_box('hero_content_which_page', 'Choose Page', 'hero_content_which_page', 'hero_content', 'normal', 'default');
}

//Slider Content
function add_slider_content(){
    add_meta_box('slider_content_name_line', 'Name Line', 'slider_content_name_line', 'slider_content', 'normal', 'default');
    add_meta_box('slider_content_heading', 'Heading', 'slider_content_heading', 'slider_content', 'normal', 'default');
    add_meta_box('slider_content_details', 'Details', 'slider_content_details', 'slider_content', 'normal', 'default');
    add_meta_box('slider_content_test', 'Testimonial', 'slider_content_test', 'slider_content', 'normal', 'default');
    add_meta_box('slider_content_page', 'Choose Page', 'slider_content_page', 'slider_content', 'normal', 'default');
}

//Fill Featured Content Blocks type fields with html
function fcb_link(){
    generate_html_for_custom_field("fcb_link",true);
}

function fcb_which_page(){
    $options = array(
        'Wallace House',
        'Knight-Wallace Fellowships',
        'Livingston Awards',
        'About'
    );
    generate_select_box_for_custom_field("fcb_which_page",$options);
}

//Fill Hero Content fields with html
function hero_content_link(){
    generate_html_for_custom_field("hero_content_link",true);
}

function hero_content_which_page(){
    $options = array(
        'Wallace House',
        'Knight-Wallace Fellowships',
        'Livingston Awards',
    );
    generate_select_box_for_custom_field("hero_content_which_page",$options);
}

//Fill Knight Wallace type custom fields with html
function kw_person_kw_fellow_first_name() {
    //pass in true for the noncename once per custom type
    generate_html_for_custom_field("kw_person_kw_fellow_first_name",true);
}

function kw_person_kw_fellow_last_name() {
    generate_html_for_custom_field("kw_person_kw_fellow_last_name");
}

function kw_person_kw_photo_add() {
    generate_html_for_custom_field("kw_person_kw_photo_add");
}

function kw_person_kw_bio() {
    generate_textarea_for_custom_field("kw_person_kw_bio");
}

function kw_person_kw_bio_private() {
    generate_textarea_for_custom_field("kw_person_kw_bio_private");
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

// function kw_person_kw_lib() {
//     generate_html_for_custom_field("kw_person_kw_lib");
// }

function kw_person_kw_locator_current_job_title() {
    generate_html_for_custom_field("kw_person_kw_locator_current_job_title");
}

function kw_person_kw_current_aff() {
    generate_html_for_custom_field("kw_person_kw_current_aff");
}

function kw_person_kw_special() {
    generate_html_for_custom_field("kw_person_kw_special");
}

function kw_person_kw_city() {
    generate_html_for_custom_field("kw_person_kw_city");
}

function kw_person_kw_state() {
    generate_html_for_custom_field("kw_person_kw_state");
}

function kw_person_kw_country() {
    generate_html_for_custom_field("kw_person_kw_country");
}

function kw_person_kw_available_for() {
    generate_html_for_custom_field("kw_person_kw_available_for");
}

function kw_person_kw_additional_info() {
    generate_html_for_custom_field("kw_person_kw_additional_info");
}

function kw_person_kw_personal_email() {
    generate_html_for_custom_field("kw_person_kw_personal_email");
}

function kw_person_kw_personal_phone() {
    generate_html_for_custom_field("kw_person_kw_personal_phone");
}

function kw_person_kw_personal_twitter() {
    generate_html_for_custom_field("kw_person_kw_personal_twitter");
}

// function kw_person_kw_username() {
//     generate_html_for_custom_field("kw_person_kw_username");
// }

// function kw_person_kw_prv() {
//     generate_html_for_custom_field("kw_person_kw_prv");
// }

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

function kw_person_liv_year() {
    generate_html_for_custom_field("kw_person_liv_year");
}

function kw_person_liv_type() {
    $options = array(
        'Excellence in Local Reporting',
        'Excellence in National Reporting',
        'Excellence in International Reporting',
        'Richard M. Clurman Award'
    );
    generate_select_box_for_custom_field("kw_person_liv_type",$options);
}

function kw_person_liv_win() {
    $options = array(
        'Winner',
        'Co-Winner',
        'Finalist'
    );
    generate_select_box_for_custom_field("kw_person_liv_win",$options);
}

function kw_person_liv_quote() {
    generate_html_for_custom_field("kw_person_liv_quote");
}

function kw_person_liv_ass() {
    generate_html_for_custom_field("kw_person_liv_ass");
}

function kw_person_liv_win_job() {
    generate_html_for_custom_field("kw_person_liv_win_job");
}

function kw_person_liv_win_aff() {
    generate_html_for_custom_field("kw_person_liv_win_aff");
}

function kw_person_liv_job() {
    generate_html_for_custom_field("kw_person_liv_job");
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
    generate_textarea_for_custom_field("kw_person_staff_bio");
}

function kw_person_staff_order() {
    generate_html_for_custom_field("kw_person_staff_order");
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

function kw_person_laj_nat() {
    generate_select_box_for_custom_field("kw_person_laj_nat",array('National','Regional'));
}

function kw_person_laj_bio() {
    generate_textarea_for_custom_field("kw_person_laj_bio");
}

//Fill in html for Donors
function kw_person_donor_name() {
    //must pass in true, at least once per custom post type
    generate_html_for_custom_field("kw_person_donor_name",true);
}

function kw_person_donor_description() {
    generate_textarea_for_custom_field("kw_person_donor_description");
}

function kw_person_donor_type(){
    $options = array(
        'Knight-Wallace Fellowships',
        'Livingston Awards',
    );
    generate_select_box_for_custom_field("kw_person_donor_type",$options);
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
        'Audio',
        'Photojournalism',
        'Journal'
    );
    generate_select_box_for_custom_field("library_item_type",$lib_item_types);
}

function library_author() {
    generate_html_for_custom_field("library_author");
}

function library_featured() {
    generate_html_for_custom_field("library_featured");
}

//Board Members
function person_board_member_first_name(){
    generate_html_for_custom_field("person_board_member_first_name",true);
}

function person_board_member_last_name(){
    generate_html_for_custom_field("person_board_member_last_name");
}

function person_board_member_title(){
    generate_html_for_custom_field("person_board_member_title");
}

function person_board_member_ass(){
    generate_html_for_custom_field("person_board_member_ass");
}

function person_board_member_bio(){
    generate_textarea_for_custom_field("person_board_member_bio");
}

//Slider Content

function slider_content_name_line(){
    generate_html_for_custom_field("slider_content_name_line",true);
}

function slider_content_heading(){
    generate_html_for_custom_field("slider_content_heading",true);
}

function slider_content_details(){
    generate_textarea_for_custom_field("slider_content_details");
}

function slider_content_test(){
    generate_textarea_for_custom_field("slider_content_test");
}

function slider_content_page(){
    $pages = array(
        'Knight-Wallace Fellowships',
        'Livingston Awards',
        'Donate'
    );
    generate_select_box_for_custom_field("slider_content_page",$pages);
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

function generate_file_html_for_custom_field($name){
    global $post;

    // Get the location data if its already been entered
    $saved_data = get_post_meta($post->ID, "_{$name}", true);

    // Echo out the field (this is so, so dirty.)
    echo '<input type="file" value="'.$saved_data.'" name="_'.$name.'" id="_'.$name.'" alt="" class="widefat" />';
}

function generate_textarea_for_custom_field($name){
    global $post;

    // Get the location data if its already been entered
    $saved_data = get_post_meta($post->ID, "_{$name}", true);

    // Echo out the field (this is so, so dirty.)
    echo '<textarea name="_'.$name.'" class="widefat">'.$saved_data.'</textarea>';
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
    $events_meta['_kw_person_kw_photo_add'] = !empty($_POST['_kw_person_kw_photo_add']) ? $_POST['_kw_person_kw_photo_add'] : null;
    $events_meta['_kw_person_kw_bio'] = !empty($_POST['_kw_person_kw_bio']) ? $_POST['_kw_person_kw_bio'] : null;
    $events_meta['_kw_person_kw_bio_private'] = !empty($_POST['_kw_person_kw_bio_private']) ? $_POST['_kw_person_kw_bio_private'] : null;
    $events_meta['_kw_person_kw_class_year'] = !empty($_POST['_kw_person_kw_class_year']) ? $_POST['_kw_person_kw_class_year'] : null;
    $events_meta['_kw_person_kw_study_pro_title'] = !empty($_POST['_kw_person_kw_study_pro_title']) ? $_POST['_kw_person_kw_study_pro_title'] : null;
    $events_meta['_kw_person_kw_current_job_title'] = !empty($_POST['_kw_person_kw_current_job_title']) ? $_POST['_kw_person_kw_current_job_title'] : null;
    $events_meta['_kw_person_kw_aff'] = !empty($_POST['_kw_person_kw_aff']) ? $_POST['_kw_person_kw_aff'] : null;
    //$events_meta['_kw_person_kw_lib'] = !empty($_POST['_kw_person_kw_lib']) ? $_POST['_kw_person_kw_lib'] : null;
    $events_meta['_kw_person_kw_locator_current_job_title'] = !empty($_POST['_kw_person_kw_locator_current_job_title']) ? $_POST['_kw_person_kw_locator_current_job_title'] : null;
    $events_meta['_kw_person_kw_current_aff'] = !empty($_POST['_kw_person_kw_current_aff']) ? $_POST['_kw_person_kw_current_aff'] : null;
    $events_meta['_kw_person_kw_special'] = !empty($_POST['_kw_person_kw_special']) ? $_POST['_kw_person_kw_special'] : null;
    $events_meta['_kw_person_kw_city'] = !empty($_POST['_kw_person_kw_city']) ? $_POST['_kw_person_kw_city'] : null;
    $events_meta['_kw_person_kw_state'] = !empty($_POST['_kw_person_kw_state']) ? $_POST['_kw_person_kw_state'] : null;
    $events_meta['_kw_person_kw_country'] = !empty($_POST['_kw_person_kw_country']) ? $_POST['_kw_person_kw_country'] : null;
    $events_meta['_kw_person_kw_available_for'] = !empty($_POST['_kw_person_kw_available_for']) ? $_POST['_kw_person_kw_available_for'] : null;
    $events_meta['_kw_person_kw_additional_info'] = !empty($_POST['_kw_person_kw_additional_info']) ? $_POST['_kw_person_kw_additional_info'] : null;
    $events_meta['_kw_person_kw_personal_email'] = !empty($_POST['_kw_person_kw_personal_email']) ? $_POST['_kw_person_kw_personal_email'] : null;
    $events_meta['_kw_person_kw_personal_phone'] = !empty($_POST['_kw_person_kw_personal_phone']) ? $_POST['_kw_person_kw_personal_phone'] : null;
    $events_meta['_kw_person_kw_personal_twitter'] = !empty($_POST['_kw_person_kw_personal_twitter']) ? $_POST['_kw_person_kw_personal_twitter'] : null;
    //$events_meta['_kw_person_kw_prv'] = !empty($_POST['_kw_person_kw_prv']) ? $_POST['_kw_person_kw_prv'] : null;
    //$events_meta['_kw_person_kw_username'] = !empty($_POST['_kw_person_kw_username']) ? $_POST['_kw_person_kw_username'] : null;

    //Livingston Winners Custom Fields
    $events_meta['_kw_person_liv_first_name'] = !empty($_POST['_kw_person_liv_first_name']) ? $_POST['_kw_person_liv_first_name'] : null;
    $events_meta['_kw_person_liv_last_name'] = !empty($_POST['_kw_person_liv_last_name']) ? $_POST['_kw_person_liv_last_name'] : null;
    $events_meta['_kw_person_liv_age'] = !empty($_POST['_kw_person_liv_age']) ? $_POST['_kw_person_liv_age'] : null;
    $events_meta['_kw_person_liv_type'] = !empty($_POST['_kw_person_liv_type']) ? $_POST['_kw_person_liv_type'] : null;
    $events_meta['_kw_person_liv_win'] = !empty($_POST['_kw_person_liv_win']) ? $_POST['_kw_person_liv_win'] : null;
    $events_meta['_kw_person_liv_quote'] = !empty($_POST['_kw_person_liv_quote']) ? $_POST['_kw_person_liv_quote'] : null;
    $events_meta['_kw_person_liv_ass'] = !empty($_POST['_kw_person_liv_ass']) ? $_POST['_kw_person_liv_ass'] : null;
    $events_meta['_kw_person_liv_win_job'] = !empty($_POST['_kw_person_liv_win_job']) ? $_POST['_kw_person_liv_win_job'] : null;
    $events_meta['_kw_person_liv_win_aff'] = !empty($_POST['_kw_person_liv_win_aff']) ? $_POST['_kw_person_liv_win_aff'] : null;
    $events_meta['_kw_person_liv_job'] = !empty($_POST['_kw_person_liv_job']) ? $_POST['_kw_person_liv_job'] : null;
    $events_meta['_kw_person_liv_lib'] = !empty($_POST['_kw_person_liv_lib']) ? $_POST['_kw_person_liv_lib'] : null;
    $events_meta['_kw_person_liv_win_job'] = !empty($_POST['_kw_person_liv_win_job']) ? $_POST['_kw_person_liv_win_job'] : null;
    $events_meta['_kw_person_liv_win_aff'] = !empty($_POST['_kw_person_liv_win_aff']) ? $_POST['_kw_person_liv_win_aff'] : null;
    $events_meta['_kw_person_liv_year'] = !empty($_POST['_kw_person_liv_year']) ? $_POST['_kw_person_liv_year'] : null;

    //Wallace House Staff Custom Fields
    $events_meta['_kw_person_staff_first_name'] = !empty($_POST['_kw_person_staff_first_name']) ? $_POST['_kw_person_staff_first_name'] : null;
    $events_meta['_kw_person_staff_last_name'] = !empty($_POST['_kw_person_staff_last_name']) ? $_POST['_kw_person_staff_last_name'] : null;
    $events_meta['_kw_person_staff_title'] = !empty($_POST['_kw_person_staff_title']) ? $_POST['_kw_person_staff_title'] : null;
    $events_meta['_kw_person_staff_bio'] = !empty($_POST['_kw_person_staff_bio']) ? $_POST['_kw_person_staff_bio'] : null;
    $events_meta['_kw_person_staff_order'] = !empty($_POST['_kw_person_staff_order']) ? $_POST['_kw_person_staff_order'] : null;

    //Livingston Award Judges Custom Fields
    $events_meta['_kw_person_laj_first_name'] = !empty($_POST['_kw_person_laj_first_name']) ? $_POST['_kw_person_laj_first_name'] : null;
    $events_meta['_kw_person_laj_last_name'] = !empty($_POST['_kw_person_laj_last_name']) ? $_POST['_kw_person_laj_last_name'] : null;
    $events_meta['_kw_person_laj_title'] = !empty($_POST['_kw_person_laj_title']) ? $_POST['_kw_person_laj_title'] : null;
    $events_meta['_kw_person_laj_aff'] = !empty($_POST['_kw_person_laj_aff']) ? $_POST['_kw_person_laj_aff'] : null;
    $events_meta['_kw_person_laj_nat'] = !empty($_POST['_kw_person_laj_nat']) ? $_POST['_kw_person_laj_nat'] : null;
    $events_meta['_kw_person_laj_bio'] = !empty($_POST['_kw_person_laj_bio']) ? $_POST['_kw_person_laj_bio'] : null;

    //Donors
    $events_meta['_kw_person_donor_name'] = !empty($_POST['_kw_person_donor_name']) ? $_POST['_kw_person_donor_name'] : null;
    $events_meta['_kw_person_donor_description'] = !empty($_POST['_kw_person_donor_description']) ? $_POST['_kw_person_donor_description'] : null;
    $events_meta['_kw_person_donor_type'] = !empty($_POST['_kw_person_donor_type']) ? $_POST['_kw_person_donor_type'] : null;

    //Library Items
    $events_meta['_library_publisher'] = !empty($_POST['_library_publisher']) ? $_POST['_library_publisher'] : null;
    $events_meta['_library_url'] = !empty($_POST['_library_url']) ? $_POST['_library_url'] : null;
    $events_meta['_library_item_type'] = !empty($_POST['_library_item_type']) ? $_POST['_library_item_type'] : null;
    $events_meta['_library_author'] = !empty($_POST['_library_author']) ? $_POST['_library_author'] : null;
    $events_meta['_library_featured'] = !empty($_POST['_library_featured']) ? $_POST['_library_featured'] : null;

    //Featured content Block
    $events_meta['_fcb_link'] = !empty($_POST['_fcb_link']) ? $_POST['_fcb_link'] : null;
    $events_meta['_fcb_which_page'] = !empty($_POST['_fcb_which_page']) ? $_POST['_fcb_which_page'] : null;

    //Hero Content Block
    $events_meta['_hero_content_link'] = !empty($_POST['_hero_content_link']) ? $_POST['_hero_content_link'] : null;
    $events_meta['_hero_content_which_page'] = !empty($_POST['_hero_content_which_page']) ? $_POST['_hero_content_which_page'] : null;

    //Board Members
    $events_meta['_person_board_member_first_name'] = !empty($_POST['_person_board_member_first_name']) ? $_POST['_person_board_member_first_name'] : null;
    $events_meta['_person_board_member_last_name'] = !empty($_POST['_person_board_member_last_name']) ? $_POST['_person_board_member_last_name'] : null;
    $events_meta['_person_board_member_title'] = !empty($_POST['_person_board_member_title']) ? $_POST['_person_board_member_title'] : null;
    $events_meta['_person_board_member_ass'] = !empty($_POST['_person_board_member_ass']) ? $_POST['_person_board_member_ass'] : null;
    $events_meta['_person_board_member_bio'] = !empty($_POST['_person_board_member_bio']) ? $_POST['_person_board_member_bio'] : null;

    //Slider Content
    $events_meta['_slider_content_name_line'] = !empty($_POST['_slider_content_name_line']) ? $_POST['_slider_content_name_line'] : null;
    $events_meta['_slider_content_heading'] = !empty($_POST['_slider_content_heading']) ? $_POST['_slider_content_heading'] : null;
    $events_meta['_slider_content_details'] = !empty($_POST['_slider_content_details']) ? $_POST['_slider_content_details'] : null;
    $events_meta['_slider_content_test'] = !empty($_POST['_slider_content_test']) ? $_POST['_slider_content_test'] : null;
    $events_meta['_slider_content_page'] = !empty($_POST['_slider_content_page']) ? $_POST['_slider_content_page'] : null;

    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        echo $key;
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

add_action('save_post', 'kw_save_events_meta', 10, 2); // save the custom fields


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
    register_sidebar( array(
        'name'          => esc_html__( 'Wallace House Footer Left', 'knight_wallace' ),
        'id'            => 'wallace-house-footer-left',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Wallace House Footer Right', 'knight_wallace' ),
        'id'            => 'wallace-house-footer-right',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'KWF Footer Left', 'knight_wallace' ),
        'id'            => 'kwf-footer-left',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'KWF Footer Right', 'knight_wallace' ),
        'id'            => 'kwf-footer-right',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Livingston Awards Footer Left', 'knight_wallace' ),
        'id'            => 'la-footer-left',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Livingston Awards Footer Right', 'knight_wallace' ),
        'id'            => 'la-footer-right',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Global Footer Left', 'knight_wallace' ),
        'id'            => 'global-footer-left',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Global Footer Right', 'knight_wallace' ),
        'id'            => 'global-footer-right',
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'knight_wallace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function knight_wallace_scripts() {
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    wp_enqueue_style( 'knight_wallace-style', get_stylesheet_directory_uri() . '/assets/stylesheets/app.css', array('font-awesome'));
    wp_enqueue_style('bx-slider', get_stylesheet_directory_uri() . '/assets/bxslider/jquery.bxslider.css');


    wp_enqueue_script('modernizer', get_stylesheet_directory_uri() . '/assets/bower_components/modernizr/modernizr.js');

  wp_enqueue_script('foundation', get_stylesheet_directory_uri() . '/assets/bower_components/foundation/js/foundation.min.js', array(), false, true);
  wp_enqueue_script('bx-slider-js', get_stylesheet_directory_uri() . '/assets/bxslider/jquery.bxslider.min.js', array('jquery'), false, true);
  wp_enqueue_script('knight_wallace-appjs', get_stylesheet_directory_uri() . '/assets/js/app.js', array('jquery', 'bx-slider-js'), false, true);



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

/**
 * Add Theme Settings
 *
 * */

function theme_settings_page(){
    echo '<div class="wrap">';
    echo '<h1>Theme Panel</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields("section");
    do_settings_sections("theme-options");
    submit_button();
    echo '</form>';
    echo '</div>';
}

function add_theme_menu_item(){
    add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function display_fellows_username_element(){
    echo '<input type="text" name="fellows_username" id="fellows_username" value="'.get_option('fellows_username').'" />';
}

function display_fellows_password_element(){
    echo '<input type="password" name="fellows_password" id="fellows_password" value="'.get_option('fellows_password').'" />';
}

function display_fellows_current_year_element(){
    echo '<input type="text" name="fellows_current_year" id="fellows_current_year" value="'.get_option('fellows_current_year').'" />';
}

function display_theme_panel_fields(){
    add_settings_section("section", "All Settings", null, "theme-options");
    add_settings_field("fellows_username", "Fellows Username", "display_fellows_username_element", "theme-options", "section");
    add_settings_field("fellows_password", "Fellows Password", "display_fellows_password_element", "theme-options", "section");
    add_settings_field("fellows_current_year", "Current Year", "display_fellows_current_year_element", "theme-options", "section");

    register_setting("section", "fellows_username");
    register_setting("section", "fellows_password");
    register_setting("section", "fellows_current_year");
}

add_action("admin_init", "display_theme_panel_fields");

/* Show future posts */
function show_future_posts($posts)
{
       global $wp_query, $wpdb;
          if(is_single() && $wp_query->post_count == 0)
                 {
                           $posts = $wpdb->get_results($wp_query->request);
                              }
             return $posts;
}
add_filter('the_posts', 'show_future_posts');

// Add a custom user role
add_role( 'alumni', __('Alumni'),array());

// Hide front end WP toolbar for Alumni users
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (current_user_can('alumni') && !is_admin()) {
        show_admin_bar(false);
    }
}




add_filter('login_redirect', 'my_login_redirect', 10, 3);
function my_login_redirect($redirect_to, $requested_redirect_to, $user) {
    $referrer = $_SERVER['HTTP_REFERER'];

    // let's not mess with the default wp-admin/wp-login.php pages
    if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {

        if (is_wp_error($user)) {

            //Login failed, find out why...
            $error_types = array_keys($user->errors);

            //Otherwise just get the first error (as far as I know there will only ever be one)
            if (is_array($error_types) && !empty($error_types)) {
                $error_type = $error_types[0];
            }
            $updated_url = add_query_arg(
                array(
                    'login' => 'failed',
                    'reason' => $error_type
                ),
                $referrer
            );
            //$redirect_to = $updated_url;
            //return $redirect_to;
            wp_redirect( $updated_url );
            exit;
        }
        else {
            wp_redirect( 'https://knight-wallace:8888/knight-wallace/sign-in/' );
        }
    }

    // return the default redirect url
    return $redirect_to;

}

// checks if current user has the Alumni role
function is_alumni_user(){
    $wp_user = wp_get_current_user();

    if(!$wp_user){ return 'error'; }

    if( $wp_user->roles[0] === 'alumni' || $wp_user->roles[0] === 'administrator') { return true; }
    return false;

}

function login_error(){

    if( isset($_GET['login']) ){ $login = $_GET['login']; }
    if( isset($_GET['reason']) ){ $reason = $_GET['reason']; }

    if(!$login || !$reason){ return; }

    switch ($reason) {
        case 'empty_username':
            $error_message = 'The username field is empty.';
            break;
        case 'empty_password':
            $error_message = 'The password field is empty.';
            break;
        case 'invalid_username':
            $error_message = 'Invalid username';
            break;
        case 'incorrect_password':
            $error_message = 'The password you entered is incorrect';
            break;
        default:
            $error_message = 'Sorry, an unknown error occured when logging you in.';
            break;
    }

    return '<p><strong>ERROR</strong>: '.$error_message.'</p>';

}



if (!function_exists('get_post_id_by_meta_key_and_value')) {
    /**
     * Get post id from meta key and value
     * @param string $key
     * @param mixed $value
     * @return int|bool
     * @author David M&aring;rtensson <david.martensson@gmail.com>
     */
    function get_post_id_by_meta_key_and_value($key, $value) {
        global $wpdb;
        $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");

        if (is_array($meta) && !empty($meta)) {
            foreach($meta as $m){
                if (wp_get_post_parent_id($m->post_id) == 789){
                    return $m->post_id;
                }
            }
        }
        else {
            return false;
        }
    }
}





// fix some badly enqueued scripts with no sense of HTTPS
add_action('wp_print_scripts', 'enqueueScriptsFix', 100);
add_action('wp_print_styles', 'enqueueStylesFix', 100);

/**
* force plugins to load scripts with SSL if page is SSL
*/
function enqueueScriptsFix() {
    if (!is_admin()) {
        if (!empty($_SERVER['HTTPS'])) {
            global $wp_scripts;
            foreach ((array) $wp_scripts->registered as $script) {
                if (stripos($script->src, 'http://', 0) !== FALSE)
                    $script->src = str_replace('http://', 'https://', $script->src);
            }
        }
    }
}

/**
* force plugins to load styles with SSL if page is SSL
*/
function enqueueStylesFix() {
    if (!is_admin()) {
        if (!empty($_SERVER['HTTPS'])) {
            global $wp_styles;
            foreach ((array) $wp_styles->registered as $script) {
                if (stripos($script->src, 'http://', 0) !== FALSE)
                    $script->src = str_replace('http://', 'https://', $script->src);
            }
        }
    }
}




// Async defer load scripts for faster page loads
// function q_async_scripts($url)
// {
//     if ( strpos( $url, '#asyncload') === false )
//         return $url;
//     else if ( is_admin() )
//         return str_replace( '#asyncload', '', $url );
//     else
//     return str_replace( '#asyncload', '', $url )."' async='async";
//     }
// add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


add_filter( 'wp_mail_from_name', 'custom_wpse_mail_from_name' );
function custom_wpse_mail_from_name( $original_email_from ) {
    return 'Wallace House';
}


/**
 * Disable Gutenberg everywhere
 */
// WP < 5.0 beta
add_filter('gutenberg_can_edit_post', '__return_false', 5);

// WP >= 5.0
add_filter('use_block_editor_for_post', '__return_false', 5);

/**
 * Enable Gutenberg on Specific Posts
 */
// function wallace_enable_gutenberg_post_ids($can_edit, $post) {
	
// 	if (empty($post->ID)) return $can_edit;
    
//     // donate page
// 	if (2705 === $post->ID) return true;
	
// 	return $can_edit;
	
// }
// // Enable Gutenberg for WP < 5.0 beta
// add_filter('gutenberg_can_edit_post', 'wallace_enable_gutenberg_post_ids', 10, 2);

// // Enable Gutenberg for WordPress >= 5.0
// add_filter('use_block_editor_for_post', 'wallace_enable_gutenberg_post_ids', 10, 2);
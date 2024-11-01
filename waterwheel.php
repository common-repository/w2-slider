<?php
/*
Plugin Name:  W2 slider
Author: Mohammad Daudul Islam
Author URI: https://www.facebook.com/mohammaddaudul.islam
Description: A simple and powerful Water Wheel plugin for creating beautiful carousel using your WordPress with shortcode easily.
Version: 1.0.2
Domain Path:/languages
Stable tag:1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: w2-slider
*/

class water_plugin_slider{

	public function __construct(){
		add_action( 'init', array($this,'waters_plugin_slider'), 0 );
		add_action('wp_enqueue_scripts', array($this, 'waters_plugin_slider_scripts'));
		add_shortcode('W2-Slider', array($this,'waters_plugin_slider_shortcode'));
	}

	public function water_plugin_slider(){
	
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	load_plugin_textdomain('w2-slider', false, dirname( __FILE__).'/languages');

	register_post_type('W2-Slider',array(
		'labels'=>array(
			'name'=>'Water Wheel Slider'
		),
		'public'=>true,
		'supports'=>array('title','thumbnail'),
		'menu_icon'=>'dashicons-format-gallery'
    ));
}
	
	public function waters_plugin_slider_scripts(){
	wp_enqueue_style('css', PLUGINS_URL('assets/css/style.css', __FILE__));
	wp_enqueue_script('minjs', PLUGINS_URL('assets/js/waterwheel.min.js', __FILE__), array('jquery'), false);
	wp_enqueue_script('cusjs', PLUGINs_URL('assets/js/waterwheelCarousel.js', __FILE__), array('jquery'), false);

}
	
	public function waters_plugin_slider_shortcode($attr, $content){
		extract(shortcode_atts(array(
		'title'=>__('Water Wheel Slider','w2-slider')
	),$attr));

	ob_start();
?>

			<div class="ktrv">
				<?php 
				$slider = new WP_Query(array(
					'post_type'=>'waters_plugin_slider',
					'posts_per_page'=>-1
				));
				?>
				<div class="noselect">
					<?php while($slider->have_posts()):$slider->the_post();?>
						<div class="wwkt" id="wwcp-1">
							<img src="<?php the_post_thumbnail_url();?>" id="wwcp-4" />
						</div>
					<?php endwhile;?>
				</div>
			</div>
<?php    
	}



// Register Custom Post Type
public function waters_plugin_slider() {

	$labels = array(
		'name'                  => _x( 'Add New Picture', 'Post Type General Name', 'w2-slider' ),
		'singular_name'         => _x( 'Water Wheel Plugin', 'Post Type Singular Name', 'w2-slider' ),
		'menu_name'             => __( 'Water Wheel Slider', 'w2-slider' ),
		'name_admin_bar'        => __( 'Add New', 'w2-slider' ),
		'archives'              => __( 'Item Archives', 'w2-slider' ),
		'attributes'            => __( 'Item Attributes', 'w2-slider' ),
		'parent_item_colon'     => __( 'Parent Item:', 'w2-slider' ),
		'all_items'             => __( 'All Items', 'w2-slider' ),
		'add_new_item'          => __( 'Add New Item', 'w2-slider' ),
		'add_new'               => __( 'Add New', 'w2-slider' ),
		'new_item'              => __( 'New Item', 'w2-slider' ),
		'edit_item'             => __( 'Edit Item', 'w2-slider' ),
		'update_item'           => __( 'Update Item', 'w2-slider' ),
		'view_item'             => __( 'View Item', 'w2-slider' ),
		'view_items'            => __( 'View Items', 'w2-slider' ),
		'search_items'          => __( 'Search Item', 'w2-slider' ),
		'not_found'             => __( 'Not found', 'w2-slider' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'w2-slider' ),
		'featured_image'        => __( 'Featured Image', 'w2-slider' ),
		'set_featured_image'    => __( 'Set featured image', 'w2-slider' ),
		'remove_featured_image' => __( 'Remove featured image', 'w2-slider' ),
		'use_featured_image'    => __( 'Use as featured image', 'w2-slider' ),
		'insert_into_item'      => __( 'Insert into item', 'w2-slidern' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'w2-slider' ),
		'items_list'            => __( 'Items list', 'w2-slider' ),
		'items_list_navigation' => __( 'Items list navigation', 'w2-slider' ),
		'filter_items_list'     => __( 'Filter items list', 'w2-slider' ),
	);
	$args = array(
		'label'                 => __( 'Water Wheel Plugin', 'w2-slider' ),
		'description'           => __( 'Post Type Description', 'w2-slider' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-migrate',
	);

	register_post_type( 'waters_plugin_slider', $args );

}

}
 new water_plugin_slider();

 ?>
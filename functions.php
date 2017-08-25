<?php

	// Register Style
	function demon_css() {
		wp_register_style( 'nunito', '//fonts.googleapis.com/css?family=Oswald:400,700', false, '6.3.1' );
		wp_enqueue_style( 'nunito' );
	}
	add_action( 'wp_enqueue_scripts', 'demon_css' );

	// Register Style
	function demon_js() {
		wp_register_script( 'demon', get_stylesheet_directory_uri() . '/js/demon.js', false, '1.0' );
		wp_enqueue_script( 'demon' );
	}
	add_action( 'wp_enqueue_scripts', 'demon_js' );

	add_action( 'init', 'custom_remove_footer_credit', 10 );
	function custom_remove_footer_credit () {
		remove_action( 'storefront_footer', 'storefront_credit', 20 );
		add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
	}

	function custom_storefront_credit() {
		?>
		<div class="site-info">
			&copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>
		</div><!-- .site-info -->
		<?php
	}

	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
	function woo_remove_product_tabs( $tabs ) {
	    unset( $tabs['additional_information'] );  	// Remove the additional information tab
	    return $tabs;
	}

	function custom_active_item_classes($classes = array(), $menu_item = false) {
	    global $post;
	    $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
	    if (isset( $id )){
		    $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item active' : '';
	    }
	    return $classes;
	}
	add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );
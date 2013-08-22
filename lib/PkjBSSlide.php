<?php

class PkjBSSlide extends PkjCoreChild{


	public function slideshow_shortcode ($atts, $content = null) {
		global $post;
		
		extract( shortcode_atts( array(
			'post_id' => false,
			'slug' => false
		), $atts ) );
		

		$out = '';
		$attachments = array();
		
		
		if ($post_id) {
			$terms = get_the_terms($post_id, 'slideshow');
			
			foreach ($terms as $term) {
				$args = array (
						'post_type' => 'attachment',
						'post_status' => 'any',
						'tax_query' => array (
								array (
										'taxonomy' => 'slideshow',
										'field' => 'slug',
										'terms' => $term->slug
								)
						)
				);
				$query = new WP_Query ( $args );
			
				while($query->have_posts()) {
					$query->the_post();
					$attachments[] = $post;
				}
				wp_reset_postdata();
			}
		} else if ($slug) {
			$args = array (
					'post_type' => 'attachment',
					'post_status' => 'any',
					'tax_query' => array (
							array (
									'taxonomy' => 'slideshow',
									'field' => 'slug',
									'terms' => $slug
							)
					)
			);
			$query = new WP_Query ( $args );
				
			while($query->have_posts()) {
				$query->the_post();
				$attachments[] = $post;
			}
			wp_reset_postdata();
		}
		
		
		
		if (!empty($attachments)) {
			$id = 'slideshow_'.md5(uniqid('slideshow_wp_'));
			
			$out = $this->view('bootstrap_slideshow.php',
			array(
				'attachments' => $attachments,
				'id' => $id
			))->render(false);
		}
		
		return $out;
	}
	
	
	public function hook_template () {
		global $post;
		
		$out = false;
		$taxs = get_post_taxonomies();
		// If we have a slideshow..
		if (in_array('slideshow', $taxs)) {
			$out = $this->slideshow_shortcode(array('post_id' => $post->ID));
		}
		
		$slideshow['output'] = $out;
		
		return $slideshow;
	}
	
	public function registerSlideshowTaxonomy() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
				'name'              => _x( 'Slideshows', 'taxonomy general name' ),
				'singular_name'     => _x( 'Slideshow', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Slideshows' ),
				'all_items'         => __( 'All Slideshows' ),
				'parent_item'       => __( 'Parent Slideshow' ),
				'parent_item_colon' => __( 'Parent Slideshow:' ),
				'edit_item'         => __( 'Edit Slideshow' ),
				'update_item'       => __( 'Update Slideshow' ),
				'add_new_item'      => __( 'Add New Slideshow' ),
				'new_item_name'     => __( 'New Slideshow Name' ),
				'menu_name'         => __( 'Slideshow' ),
		);
		
		$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => false,
				'rewrite'           => array( 'slug' => 'slideshow' ),
		);
		
		register_taxonomy( 'slideshow', array( 'attachment', 'page' ), $args );
	}
	
	public function setup () {
	
		add_shortcode('slideshow', array($this, 'slideshow_shortcode'));
		
		add_filter('pkj_slideshow', array($this, 'hook_template'));
		
		//$this->registerPostType(new PkjBSSlidePostTypeSlideshow());
		
		
		$this->registerSlideshowTaxonomy();
		
	}
	
}
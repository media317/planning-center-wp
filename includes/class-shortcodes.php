<?php 

/**
* Load the base class
*/
class Planning_Center_WP_Shortcodes {
	
	function __construct()	{
		
		add_shortcode( 'pcwp_people', array( $this, 'people' ) );

	}

	public function people( $atts ) 
	{
		$args = shortcode_atts( array(
			'method' 	=> '',
			'parameters'	=> '',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$people = $api->get_people( $args );

    	ob_start(); ?>

    	<?php 
    		echo '<h3 class="planning-center-wp-title">' . ucwords( $args['method'] ) . ' in People</h3>';
    		if ( is_array( $people ) ) {
				
				echo '<ul class="planning-center-wp-list planning-center-wp-people-list">';
				foreach( $people as $person ) {
					
					echo '<li>' . $person->attributes->first_name . ' ' . $person->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p class="planning-center-wp-not-found">No results found.</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return apply_filters('planning_center_wp_people_shortcode_output', $content ); 	

	}

	
}


			

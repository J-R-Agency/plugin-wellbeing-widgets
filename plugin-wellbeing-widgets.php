<?php
/*
Plugin Name: General Widgets for Wellbeing Liverpool
Plugin URI: https://www.jnragency.co.uk/
Description: General Widgets for Wellbeing Liverpool
Version: 0.1
Author: GM
Author URI: https://www.jnragency.co.uk/
*/

// Register and load the widget
function jr_wl_load_widget() {
    register_widget( 'jr_wl_widget' );
}
add_action( 'widgets_init', 'jr_wl_load_widget' );
 
// Creating the widget 
class jr_wl_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'jr_wl_widget', 
 
// Widget name will appear in UI
__('Wellbeing Liverpool Map Widget', 'jr_wl_widget_domain'), 
 
// Widget description
array( 'description' => __( 'Beta widget for displaying profile maps', 'jr_wl_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
 
// This is where you run the code and display the output
echo __( '', 'jr_wl_widget_domain' );

// Initialise global api key
global $wl_google_api_key;

// Display sidebar map
echo "
<iframe
  width=\"100%\"
  height=\"300\"
  frameborder=\"0\" style=\"border:0\"
  src=\"https://www.google.com/maps/embed/v1/place?key=" . $wl_google_api_key . "&q=Sunflowers,Liverpool\" allowfullscreen>
</iframe>";



echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'jr_wl_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class jr_widget ends here
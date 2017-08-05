<?php
/**
 * Funciton to style widget boxes based on their position in the list, even or odd. 
 * Adapted from the example function given at 
 * https://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets/
 */

function widget_uclq_style($params) {
    global $my_widget_num; // Global a counter array
    $this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
    $arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets  
    if(!$my_widget_num) {// If the counter array doesn't exist, create it
        $my_widget_num = array();
    }
    if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
        return $params; // No widgets in this sidebar... bail early.
    }
    if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
        $my_widget_num[$this_id] ++;
    } else { // If not, create it starting with 1
        $my_widget_num[$this_id] = 1;
    }
    $panel_open='<div';
    $title_open='<div class="panel-heading ';
    $title_close='</div>';
    $class = 'class="panel panel-default '; 
    if(($my_widget_num[$this_id]%2) == 0) { // If this an even numbered widget
        $title_class = 'widget-even">';
    } else { // If this is an odd numbered widget
        $title_class = 'widget-odd">';
    }
    $params[0]['before_widget'] = str_replace('<aside', $panel_open, $params[0]['before_widget']);
    $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
    $params[0]['before_title'] = str_replace('h3', 'h3', $title_open . $title_class . $params[0]['before_title']);
    $params[0]['after_title'] = str_replace('h3', 'h3', $params[0]['after_title'] . $title_close);
    $params[0]['after_widget'] = str_replace('/aside', '/div', $params[0]['after_widget']);
    return $params;
}
add_filter('dynamic_sidebar_params','widget_uclq_style');

class UCLQ_Events_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'uclq_events_widget',
            esc_html__('UCLQ Events Widget', 'text_domain'),
            array('description' => esc_html__('A widget to display events from the UCLQ Calendar', 'text_domain'), )
            );
    }

    public function widget($args, $instance){
        echo $args['before_widget'];
        echo $args['before_title']. apply_filters(widget_title, 'Events') . $args['after_title'];
        echo '<p> Placeholder</p><p> Placeholder</p><p> Placeholder</p><p> Placeholder</p>';
        echo $args['after_widget'];
    }

    public function form($instance){
        echo '<p class="no-options-widget">' . __('There are no options for this widget.') . '</p>';
        return 'noform';
    }

    public function update($new_instance, $old_instance){
        return $new_instance;
    }
}

class UCLQ_Twitter_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'uclq_twitter_widget', // Base ID
            esc_html__( 'UCLQ Twitter Widget', 'text_domain' ), // Name
            array( 'description' => esc_html__( 'A widget to embed a twitter profile, with the _UCLQ styled panel headings.', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo '<a class="twitter-timeline" data-height="400" data-link-color="#E81C4F" href="https://twitter.com/'.$instance['twitter_id'].'">Tweets by '.$instance['twitter_id'].'</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Follow Us On Twitter', 'text_domain' );
        $twid = ! empty( $instance['twitter_id']) ? $instance['twitter_id'] : esc_html__('uclquantum', 'text_domain');
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            <?php esc_attr_e( 'Title:', 'text_domain' ); ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        <label for="<?php echo esc_attr($this->get_field_id(' twitter_id' ));?>">
            <?php esc_attr_e('Twitter ID: @', 'text_domain');?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) );?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_id' ) );?>" type="text" value="<?php echo esc_attr( $twid);?>"
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : $old_instance['title'];
        $instance['twitter_id'] = ( ! empty( $new_instance['twitter_id'] ) ) ? strip_tags( $new_instance['twitter_id'] ) : $old_instance['twitter_id'];
        return $instance;
    }

} // class UCLQ_Twitter_Widget



// register Foo_Widget widget
function register_uclq_widgets() {
    register_widget( 'UCLQ_Events_Widget' );
    register_widget( 'UCLQ_Twitter_Widget' );
}
add_action( 'widgets_init', 'register_uclq_widgets' );

?>

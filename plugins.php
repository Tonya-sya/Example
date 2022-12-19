<?php
/*
Plugin Name: weather
*/
?>
<?php
class widget_weather extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_weather',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'widget_weather', 'My Widget', $widget_ops );

        add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ),  array($this,'my_plugin_action_links' ));
        add_action('admin_menu',  array( $this,'add_option_field_to_general_admin_page'));
	}
   public function my_plugin_action_links( $links ) {
    $links = array_merge( array(
        '<a href="' . esc_url( admin_url( '/options-general.php' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
    ), $links );

    return $links;
    }
    public function add_option_field_to_general_admin_page(){
        $wet_appid = 'appid';
        // регистрируем опцию
        register_setting( 'general', 'appid' );
        // добавляем поле
        add_settings_field(
            'appid',
            'With plugin "Weather" API key',
            array( $this, 'appid_callback_function'),
            'general',
            'default',
            array(
                'id' => 'appid',
                'option_name' => 'appid'
            )
        );
    }
    public function appid_callback_function($wet_appid){
    $id = $wet_appid['id'];
    $wet_appid = $wet_appid['option_name'];
        ?>
        <input
            type="text"
            name="<?php echo $wet_appid; ?>"
            id="<?php echo $id; ?>"
            value="<?php echo esc_attr( get_option('appid') ); ?>"
        />
        <?php
    }
    /**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	 public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $this-> get_data(
            'https://api.openweathermap.org/data/2.5/weather',
            array_merge(
                $instance,
                array(
                    'appid' => get_option('appid'),
                    'mode' => 'html'

                )
            )
        );
        echo $args['after_widget'];

    }
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
        $city_name = $instance['q'];
        ?>
        <!--select city-->
        <p></p><label for="<?php echo $this->get_field_id( 'q' ); ?>">City name:</label>
        <input class="widefat" type="text" name="<?php echo $this->get_field_name( 'q' ); ?>" id="<?php echo $this->get_field_id( 'q' ); ?>"
               value="<?php echo esc_attr($city_name); ?>">
        </p>
        <?php
    }
	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['q'] = ( ! empty( $new_instance['q'] ) ) ? strip_tags( $new_instance['q'] ) : '';
		return $instance;
	}
	protected function get_data($url, $args)
    {
        $cache_key = 'weather_widget';
        ksort($args, SORT_NATURAL);
        foreach ($args as $key => $arg) {
            $cache_key .= '_' . $key . '_' . $arg;
        }
        return $this->maybe_cached($cache_key, $url, $args);

    }

    protected function maybe_cached($cache_key, $url, $args)
    {
    	//$your_weather = delete_transient($cache_key);
    	 $your_weather = get_transient($cache_key);
        	if ( false === $your_weather ) {
        	$request = add_query_arg($args, $url);
			$your_weather = wp_remote_get($request);
			$your_weather = wp_remote_retrieve_body( $your_weather );
            set_transient($cache_key, $your_weather, 5 * MINUTE_IN_SECONDS);
        }

        return $your_weather;
    }
}
	add_action('widgets_init', 'my_register_widgets');
	function my_register_widgets() {
		register_widget('widget_weather');
	}

<?php

class socialsWidget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
          'classname'   => 'socials_widget',
          'description' => __('Widget for socials'),
        );

        parent::__construct( 'socials_widget', 'Socials', $widget_options );
    }

    public function widget($args, $instance) {
        $output = '';

        if(!empty($instance['title'])) {
            $output .= '<p class="social-widget-title">'.$instance['title'].'</p>';
        }
    
        $output .= '<div class="socials-container">';
        
        foreach($instance as $key => $url) {
            if(empty($url) || $key == 'title') continue;

            $output .= '<div class="social-account">';
            $output .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="social-link"><i class="social-icon social-icon--' . $key . ' fab fa-' . $key . '"></i></a>';
            $output .= '</div>';
        }

        $output .= '</div>';

        echo $output;
    }

    public function form($instance) {
        $title     = !empty( $instance['title'] ) ? $instance['title'] : '';
        $facebook  = !empty( $instance['facebook'] ) ? $instance['facebook'] : '';
        $instagram = !empty( $instance['instagram'] ) ? $instance['instagram'] : '';
        $twitter   = !empty( $instance['twitter'] ) ? $instance['twitter'] : '';
        $twitch    = !empty( $instance['twitch'] ) ? $instance['twitch'] : '';
        $linkedin  = !empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $youtube   = !empty( $instance['youtube'] ) ? $instance['youtube'] : '';

        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $facebook ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'instagram' ); ?>">Instagram:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instagram ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $twitter ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'twitch' ); ?>">Twitch:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'twitch' ); ?>" name="<?php echo $this->get_field_name( 'twitch' ); ?>" value="<?php echo esc_attr( $twitch ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">LinkedIn:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $linkedin ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'youtube' ); ?>">YouTube:</label>
                <input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_attr( $youtube ); ?>" />
            </p>
        <?php 
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        $instance[ 'facebook' ] = strip_tags( $new_instance[ 'facebook' ] );
        $instance[ 'instagram' ] = strip_tags( $new_instance[ 'instagram' ] );
        $instance[ 'twitter' ] = strip_tags( $new_instance[ 'twitter' ] );
        $instance[ 'twitch' ] = strip_tags( $new_instance[ 'twitch' ] );
        $instance[ 'linkedin' ] = strip_tags( $new_instance[ 'linkedin' ] );
        $instance[ 'youtube' ] = strip_tags( $new_instance[ 'youtube' ] );

        return $instance;
    }
}

    function register_socials_widget() { 
        register_widget( 'socialsWidget' );
    }

    add_action('widgets_init', 'register_socials_widget');
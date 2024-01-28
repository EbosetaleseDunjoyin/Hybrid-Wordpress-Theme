<?php 

/**
 * Tne Media FIle 
 * 
 * @package devwp
 */

if ( ! function_exists( 'devwp_add_thumb_column' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function devwp_add_thumb_column(array $cols) {
		$cols['thumbnail'] = esc_html__('Thumbnail','devwp');

        return $cols;
		
	}

    add_filter('manage_posts_columns','devwp_add_thumb_column',2);
    add_filter('manage_pages_columns','devwp_add_thumb_column',2);
endif;

if ( ! function_exists( 'devwp_display_thumb_value' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function devwp_display_thumb_value(string $column_name, int $post_id) {
		$width = 60;
        $height = 60;
		
        if('thumbnail' === $column_name){
            $thumbnail_id = get_post_meta($post_id, 'thumbnail_id', true);
            $attachments = get_children(
                array(
                    'post_parent' => $post_id,
                    'post_type' => 'attachement',
                    'post_mime_type' => 'image',

                )
            );

            if($thumbnail_id){
                $attachment = wp_get_attachment_image($thumbnail_id, array($width, $height), true);

            }elseif($attachments){
                foreach($attachments as $attachment_id => $attachment){
                    $attachment = wp_get_attachment_image($attachment_id, array($width, $height), true);
                }
            }

            if(isset($attachment)){
                echo wp_kses_post($attachment);
            } else {
                echo esc_html('None');
            }
        }
	}

    add_filter('manage_posts_custom_column','devwp_display_thumb_value',5,2);
    add_filter('manage_pages_custom_column','devwp_display_thumb_value',5,2);
endif;
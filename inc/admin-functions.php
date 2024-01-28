<?php 

/**
 * THe Admin FUnctions
 * 
 * @package Devwp
 */

if(!defined('ABSPATH')) exit;

if(! function_exists('devwp_logged_in')):
    function devwp_logged_in() : void {
        if(is_user_logged_in() && !is_customize_preview()){
            ?>
            <style>
                body.logged-in nav.fixed-top{
                    top:32px;

                }
            </style>
            <?php
        }
    }

    add_action('wp_body_open', 'devwp_logged_in', 5);
endif;

if(!function_exists('devwp_show_id_column')):

    function devwp_show_id_column(array $columns) : array {
        $columns['showid_id'] = esc_html__('ID', 'devwp');

        return $columns;
    }

    add_filter('manage_posts_columns' , 'devwp_show_id_column', 5);
    add_filter('manage_pages_columns' , 'devwp_show_id_column', 5);
    add_filter('manage_media_columns' , 'devwp_show_id_column', 5);
    add_filter('manage_users_columns' , 'devwp_show_id_column', 5);

endif;


if(!function_exists('devwp_show_id_column_content')):

    function devwp_show_id_column_content(string $column, int $id): void {
        if('showid_id' === $column){
            echo esc_html($id);
        }
    }
    add_filter('manage_posts_custom_column', 'devwp_show_id_column_content', 5, 2);
    add_filter('manage_pages_custom_column', 'devwp_show_id_column_content', 5, 2);
    add_filter('manage_media_custom_column', 'devwp_show_id_column_content', 5, 2);

endif;

if(!function_exists('devwp_show_user_id_column_content')):

    function devwp_show_user_id_column_content(string $value, int $column_name, int $user_id) {
        if('showid_id' === $column_name){
            return $user_id;
        }
        return $value;
    }
    add_filter('manage_users_custom_column', 'devwp_show_user_id_column_content', 10, 3);
    

endif;

if(!function_exists('devwp_footer_admin_text')):

    function devwp_footer_admin_text() : void {
        ?>
            <a href="<?php echo esc_url(__('','devwp')) ?>">
            <?php 
            printf(
                esc_html__('DevWP THeme By: %s', 'devwp'),
                "EDTheme"
            );
        ?>
        </a>
        <?php
    }
    add_filter('admin_footer_text', 'devwp_footer_admin_text');
    

endif;
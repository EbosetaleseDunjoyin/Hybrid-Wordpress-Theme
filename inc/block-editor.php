<?php 

if(!defined("ABSPATH")) exit;

$devwp_enable_gut = get_theme_mod('enable_gut','yes');

if('yes' === $devwp_enable_gut){
    if(! function_exists('devwp_block_support')):
        function devwp_block_support(){
            add_theme_support('wp-block-styles');

            add_theme_support('editor-styles');

            add_theme_support('responsive-embeds');

            add_theme_support('apperance-tools');

            add_theme_support('block-nav-menus');

            add_theme_support('experimental-link-color');

            add_theme_support('block-templates');

            add_theme_support('block-template-parts');

            add_theme_support('align-wide');

            add_theme_support('custom-spacing');

            add_theme_support('custom-units', 'rem', 'em');


            add_theme_support(
                'editor-font-sizes',
                array(
                    array(
                        'name' => esc_attr__('Small','devwp'),
                        'size' => 12,
                        'slug' => 'small'
                    ),
                    array(
                        'name' => esc_attr__('Regular','devwp'),
                        'size' => 16,
                        'slug' => 'regular'
                    ),
                    array(
                        'name' => esc_attr__('Large','devwp'),
                        'size' => 36,
                        'slug' => 'large'
                    ),
                    array(
                        'name' => esc_attr__('Huge','devwp'),
                        'size' => 12,
                        'slug' => 'huge'
                    ),
                )
            );

            add_theme_support('editor-gradient-presets', array());


            
        }
    endif;
    add_action('after_setup_theme','devwp_block_support');
}else{

    add_filter('use_widgets_block_editor','__return_false');
    add_filter('gutenberg_can_edit_post','__return_false');

    add_filter('use_block_editor_for_post_type','__return_false',10);

    add_action(
        'wp_enqueue_scripts',
        function(){
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('global-styles');
            wp_dequeue_style('clasic-theme-styles');
        },
        20
    );

    add_action(
        'wp_footer',
        function(){
            wp_dequeue_style('core-block-supports');
        }
    );

    remove_action('wp_body_open','wp_global_styles_render_svg_filters');
    remove_action('wp_enqueue_scripts','wp_enqueue_global_styles');
    remove_action('wp_footer','wp_enqueue_global_styles',1);


}




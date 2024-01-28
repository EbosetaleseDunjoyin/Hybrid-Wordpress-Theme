<?php 

/**
 * Our Standard Loop
 * 
 * @package Devwp
 */

if(!defined('ABSPATH')) exit;

while(have_posts()) :

    the_post();

    get_template_part('template-parts/content', get_post_type());

    echo '<hr/>';
endwhile;

if(is_single()){
    devwp_post_nav();
}elseif(!is_page()){
    devwp_pagination();
}

if(is_active_sidebar('below-content') && !is_archive()){

    dynamic_sidebar('below-content');

    echo '<hr/>';
}

if(is_singular()){
    if (comments_open() || get_comments_number()):
        comments_template();
    endif;

}


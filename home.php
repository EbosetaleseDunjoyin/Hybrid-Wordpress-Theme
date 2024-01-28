<?php 
/**
 * Home Page
 * 
 * @package  devwp
 */

if(!defined("ABSPATH")){
    exit;
}

get_header();

$devwp_header_img_check = get_theme_mod('home_header_img');


if(is_customize_preview() && !empty($devwp_header_img_check)){ ?>
    <div class="header-image position-relative d-flex justify-content-center align-items-center <?php devwp_navbar_check() ?>">
            <img src="<?php header_image() ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>"
                alt="<?php bloginfo('name') ?>">
            <?php devwp_header_text(); ?>
    </div>
 <?php
}

?>

<div class="container <?php devwp_header_img_set() ?>">
    <div id="content" class="row pt-4">
        <main class="site-main content-area col-md-8 col-12" id="primary">
            <?php
           

            if (have_posts()):
                
                get_template_part('template-parts/loop');
            else:     
                get_template_part('template-parts/content', 'none');
            
            endif;
            ?>


        </main>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
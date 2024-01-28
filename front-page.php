<?php 
/**
 * The Front Page
 * 
 * @package DevWp
 */

 if(!defined('ABSPATH')){
    exit;
 }
get_header();
if(has_custom_header()){
    if(has_header_image()){ ?>

        <div class="header-image position-relative d-flex justify-content-center align-items-center <?php devwp_navbar_check() ?>">
            <img src="<?php header_image() ?>" 
            width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php bloginfo('name') ?>">
            <?php devwp_header_text(); ?>
        </div>


    <?php
    }elseif(has_header_video()){

        ?>
        <div class=<?php devwp_navbar_check() ?> >
            <?php the_custom_header_markup(); ?>
        </div>

        <?php



    }
}
?>

<div class="container <?php devwp_header_img_set() ?>">
    <div id="content" class="row pt-4">
        <main class="site-main content-area col-md-8 col-12" id="primary">
            <?php 
                $devwp_fp_args = array(
                    'post_type'  => 'post',
                    'post_per_page' => 5,
                    'post__not_in'  > get_option('sticky_posts'),

                );

                $devwp_custom_query = new WP_Query($devwp_fp_args);

                if($devwp_custom_query->have_posts()):
                    while($devwp_custom_query->have_posts()):
                        $devwp_custom_query->the_post();
                        get_template_part('template-parts/content', get_post_type());
                        echo '<hr/>';
                    endwhile;
                    wp_reset_postdata();
                endif;
            ?>

            
        </main>
        <?php
            get_sidebar();
        ?>
    </div>
</div>


<?php


get_footer();

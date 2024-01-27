<?php 

/**
 * 
 * Extra functions to Enhance DEvWP
 * 
 * @package DevWP
 */

 if(!defined("ABSPATH")){
    exit;
 }


 if(!function_exists('devwp_header_text')){

    function devwp_header_text(): void{
        $fp_header_toptext = get_theme_mod('fp_header_toptext');
        $fp_header_btmtext = get_theme_mod('fp_header_btmtext');
        $fp_header_button_url = get_theme_mod('fp_header_button_url');
        $fp_header_button = get_theme_mod('fp_header_button');
        $bp_header_toptext = get_theme_mod('bp_header_toptext');
        $bp_header_btmtext = get_theme_mod('bp_header_btmtext');
        $bp_header_button_url = get_theme_mod('bp_header_button_url');
        $bp_header_button = get_theme_mod('bp_header_button');

        ?>
        <div class="header-info position-absolute row g-0 z-3">
            <div class="col-12 text-center text-white">
                <p class="mb-0 header-smtext border-bottom fs-2 pb-1">
                    <?php 
                        if(is_front_page()){
                            echo esc_html($fp_header_toptext);
                        }elseif(is_home()){
                           echo esc_html($bp_header_toptext);
                        }

                    ?>
                </p>

                <p class="mb-1 header-text fs-1">
                    <?php 
                        if(is_front_page()){
                            echo esc_html($fp_header_btmtext);
                        }elseif(is_home()){
                           echo esc_html($bp_header_btmtext);
                        }

                    ?>
                </p>

               <?php if($fp_header_button_url && is_front_page()) { ?>
                    <a href="<?php echo esc_url($fp_header_button_url) ?>" class="btn btn-outline-light header-button fs-6">
                        <?php echo esc_url($fp_header_button) ?>
                    </a>
                <?php } ?>

               <?php if($bp_header_button_url && is_home()) { ?>
                    <a href="<?php echo esc_url($bp_header_button_url) ?>" class="btn btn-outline-light header-button fs-6">
                        <?php echo esc_url($bp_header_button) ?>
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php
    }
 }

 if ( ! function_exists('devwp_header_img_set') ){


    function devwp_header_img_set(){
        $navbar_type = get_theme_mod('devwp_navbar_type', 'offcanvas');
        $header_img = '';

        if( is_front_page() ){
            if(!has_custom_header() && 'collapse' !== $navbar_type ){
                $header_img = 'mt-6';
            }else{
                $header_img = 'mt-1';
            }
        } elseif (is_home()) {
            if (!get_theme_mod('home_header_img') && 'collapse' !== $navbar_type) {
                $header_img = 'mt-6';
            } else {
                $header_img = 'mt-1';
            }
        }

        echo esc_attr($header_img);
    }
 }

 if ( ! function_exists('devwp_navbar_check') ){

    function devwp_navbar_check(){
        $navbar_type = get_theme_mod('devwp_navbar_type', 'offcanvas');
        $nb_check = '';

        
        if( 'offcanvas' === $navbar_type ){
            $nb_check = 'mt-6';
        }else{
            $nb_check = 'mt-1';
        }
       

        echo esc_attr($nb_check);
    }
 }

 if ( ! function_exists('devwp_excerpt_more') ){

    function devwp_excerpt_more() : string {
       return sprintf('<a classs="moretag d-block mt-2" href="%1$s">%2$s</a> ',get_permalink(get_the_ID()), esc_html__('Read More &raquo;', 'devwp'));
       

    }
    add_filter('except_more', 'devwp_excerpt_more');
 }

 if ( ! function_exists('devwp_excerpt_length') ){

    function devwp_excerpt_length() : int {
        $excerpt = get_theme_mod('exc_length','40');

        return absint( $excerpt );
       

    }
    add_filter('except_length', 'devwp_excerpt_length', 99);
 }

 if ( ! function_exists('devwp_login_url') ){

    function devwp_login_url() : string {
        $url = home_url();

        return esc_url( $url );
       

    }
    add_filter('login_headerurl', 'devwp_login_url', 99);
 }

 if ( ! function_exists('devwp_social_menu') ){

    function devwp_social_menu() : void {
       if(has_nav_menu('social')){
        ?>
            <p class="h3 mt-1">Connect With Us</p>
                <?php 
                wp_nav_menu(
                    array(
                        'container_class' => 'menu-social py-3',
                        'container_id' => 'menu-social',
                        'menu_class' => 'menu-items mb-0',
                        'menu_id' => 'menu-social-tems',
                        'fallback_cb' => false,
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                        'depth'  => 1,
                        'theme_location' => 'social',
                    ) 
                );

       
       }
       

    }
   
 }

 


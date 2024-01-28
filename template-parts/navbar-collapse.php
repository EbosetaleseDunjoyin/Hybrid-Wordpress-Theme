<?php

/**
 * The Navbar Collapse
 * 
 * @package devwp
 */

if (!defined('ABSPATH'))
    exit;

?>

<nav id="menu" class="navbar navbar-expanded-md bg-dark navbar-dark fixed-top">
    <div class="container">
        <?php get_template_part('template-parts/navbar-brand') ?>

        <button 
            class="navbar-toogler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarDropdown"
            aria-controls="navbarDropdown" aria-expanded="false"
            aria-label="<?php esc_attr_e('Toggle Navigation', 'devwp'); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            wp_nav_menu(
                array(
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navbarDropdown',
                    'menu_class' => 'navbar-nav ms-auto',
                    'menu_id' => 'menu',
                    'fallback_cb' => false,
                    'depth' => 2,
                    'walker' => new Devwp_Bs5Navwalker(),
                    'theme_location' => 'primary'
                )
            )
        ?>


    </div>
</nav>
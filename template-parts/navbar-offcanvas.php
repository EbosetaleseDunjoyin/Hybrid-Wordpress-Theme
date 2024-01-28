<?php 

/**
 * The Navbar Offcanvas
 * 
 * @package devwp
 */

if(!defined('ABSPATH')) exit;

?>

<nav id="menu" class="navbar navbar-expanded-md bg-dark navbar-dark fixed-top">
    <div class="container">
        <?php get_template_part('template-parts/navbar-brand') ?>

        <button 
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar"
            aria-expanded="false"
            aria-label="<?php esc_attr_e('Toggle Navigation', 'devwp'); ?>"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="offcanvas offcanvas-end navbar-dark bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header justify-content-end">
        <i class="bi bi-x-lg text-white" data-bs-dismiss="offcanvas" aria-label="Close"></i>
      </div>
        <?php 
            wp_nav_menu(
                array(
                    'container_class' => 'offcanvas-body',
                    'menu_class' => 'navbar-nav justify-content-end flex-grow-1',
                    'menu_id' => 'menu',
                    'fallback_cb' => false,
                    'depth' => 2,
                    'walker' => new Devwp_Bs5Navwalker(),
                    'theme_location' => 'primary'
                )
            )
        ?>
    </div>

        
    </div>
</nav>
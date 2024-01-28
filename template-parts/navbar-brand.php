<?php 
/**
 *  The Navbar Brand
 * 
 * @package Devwp
 * 
 */

 if(!defined("ABSPATH")) exit;

if(!has_custom_logo()): 

?>

<div class="navbar-brand">
    <?php   if (is_front_page() || is_home()  || is_front_page() && is_home() ) : 
				?>
				<h1 class="site-title m-0 p-0 lh-base"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('name'); ?>
            </a></h1>
        <?php
        else:
         ?>
        <p class="site-title m-0 p-0 lh-base"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('name'); ?>
            </a></p>
        <?php
    endif;
    $devwp_description = get_bloginfo('description', 'display');
    if ($devwp_description || is_customize_preview()):
        ?>
            <p class="site-description mb-0">
                <?php echo $devwp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </p>
    <?php endif; ?>
</div>

<?php 

else:
    the_custom_logo();
endif;
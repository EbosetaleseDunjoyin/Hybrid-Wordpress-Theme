<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DevWP
 */

if ( ! defined("ABSPATH") ) {
	exit;
}

// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	return;
// }

if(! is_active_sidebar('right-sidebar')):

?>

<aside id="secondary" class="widget-area widget col-md-4 mt-1">

	<?php get_search_form(); ?>
	<hr/>

	<h3 class="widget-title"><?php esc_html_e('Archives', 'devwp' ); ?></h3>

	<ul>
		<?php wp_get_archives(array('type' => 'monthly')); ?>
	</ul>

	<hr/>

	<h3 class="widget-title"><?php esc_html_e('Meta', 'devwp' ); ?></h3>

	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>

</aside>

<?php else: ?>
	<aside id="secondary" class="widget-area widget col-md-4 mt-1">

		<?php dynamic_sidebar('right-sidebar') ?>

	</aside>

<?php endif; ?>
<!-- #secondary -->

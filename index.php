<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DevWP
 */
if(!defined("ABSPATH")) exit;

get_header();
?>

	<main id="primary" class="site-main content-area col-md-8">

		<?php
		if ( have_posts() ) :

			if(is_archive()): ?>

			<header class="page-header">
				<?php
					the_archive_title('<h1>','</h1>');
					the_archive_description('<dive class="archive-description">','</div>')
				?>
			</header>
			
			<?php endif; ?>
			<?php if(is_search()): ?>
				<header class="page-header">
					<h1 class="page-title">
						<?php printf(esc_html__('Search Results for: %s','devwp'),'<span>'.get_search_query().'</span>') ?>
					</h1>
			
				</header>
			<?php
				endif;
				get_template_part( 'template-parts/loop' );

			
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

<?php
/*
	Template Name: Products sub 1
 */

// ps1
// Page for sub category.
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			global $wp_query;
			//If query_vars[] value change, need to update in functions.php
			echo 'Main Category : ' . $wp_query->query_vars['m0'];
			echo '<br />';
			echo 'Sub Category : ' . $wp_query->query_vars['s1'];

			// while ( have_posts() ) : the_post();
			//
			// 	get_template_part( 'template-parts/page/content', 'page' );
			//
			// 	// If comments are open or we have at least one comment, load up the comment template.
			// 	if ( comments_open() || get_comments_number() ) :
			// 		comments_template();
			// 	endif;
			//
			// endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();

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
			global $wpdb;
			//If query_vars[] value change, need to update in functions.php
			// echo 'Main Category : ' . $wp_query->query_vars['m0'];
			// echo '<br />';
			// echo 'Sub Category : ' . $wp_query->query_vars['s1'];

			$p1m0 = $wp_query->query_vars['m0'];	//assign query value
			$p1s1 = $wp_query->query_vars['s1'];	// assign query value
			// print_r($p1m0);
			// print_r($p1s1);

			$main_category = $wpdb->get_results("SELECT DISTINCT m0 From wp_prod0;");
			// $main_category2 = $main_category;
			$sub_category2 = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE m0='$p1m0' AND s1='$p1s1';");
			// print_r($sub_category1);

			// print_r($main_category);
			echo "<table>";
			echo "<td class='cat-bar'>";
			echo "<h4>PRODUCT CATEGORIES</h4>";
			foreach($main_category as $main_category) {
				$s1_category = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$main_category->m0';");
				// print_r($main_category->m0);
				// print_r(gettype($temp_var));
				// print_r(sizeof($s1_category));
				// print_r($s1_category[0]->s1);
				if(!empty($s1_category[0]->s1)){
					// echo "<div>";
					echo "<div class='accordion'><img class='chev' src='http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png'>&nbsp".$main_category->m0."</div>";
					echo "<div class='panel'>";
					foreach($s1_category as $s1_category) {
						$s2_category = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE s1 = '$s1_category->s1';");
						if(!empty($s2_category[0]->s2)){
							echo "<div class='accordion'><img class='chev' src='http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png'>&nbsp".$s1_category->s1."</div>";
							echo "<div class='panel'>";
							foreach($s2_category as $s2_category) {
								echo "<div class='accordion no-sub'><a class='no-sub' href='products/ps2/?m0=".$main_category->m0."&s1=".$s1_category->s1."&s2=".$s2_category->s2."'>".$s2_category->s2."</a></div>";
							}
							echo "</div>";  // end panel
						} else {
							echo "<div class='accordion'><a class='no-sub' href='products/ps2/?m0=".$main_category->m0."&s1=".$s1_category->s1."&s2=".$s2_category->s2."'>".$s1_category->s1."</a></div>";
						}
					}
					echo "</div>";  // end panel.
				}
				else {
					echo "<div class='accordion'>".$main_category->m0."</div>";
				}
				// echo "<hr/>";
				// echo "</div>";
			}
			echo "</td>";
			// END Main Category accordion panel.

			// Start Right column.
			echo "<td class='prod-display'>";
			// echo "<h1> HELLO </h1>";
			// $mPos = 0;
			echo "<div class='group-container'>";
			echo "<div class='m-title'><a href='products/'>".$p1m0."</a>  >>  ".$p1s1."</div>";	//Title
				// $s1_category2 = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$main_category2->m0';");
				echo "<div class='s1-box-background'>";
				foreach($sub_category2 as $sub_category2) {
				// $counter = 0;
				$img = $wpdb->get_results("SELECT img0 FROM wp_prod0 WHERE s2 = '$sub_category2->s2' AND img0 IS NOT NULL;");
				// print_r(sizeof($img));
				echo "<a href='products/ps2/?m0=".$p1m0."&s1=".$p1s1."&s2=".$sub_category2->s2."' class='s1-box'>";
				echo "<div class='item-img'>";
				if (sizeof($img) > 1) {
					// foreach($img as $img) {
					// 	echo "<img src='' height='100' width='100'>";
					// }
					echo "<img src='".$img[array_rand($img)]->img0."' height='100' width='100'>";
				} elseif (sizeof($img)===1) {
					// print_r($img->img0);
					echo "<img src='".$img[0]->img0."' height='100' width='100'>";
				} else {
					echo "<img src='http://files.coda.com.s3.amazonaws.com/imgv2/c_logo.jpg' height='100' width='100'>";
				};
				// echo "<img src='https://s3.amazonaws.com/files.coda.com/content/prod/categories/193-brandedcableties.jpg' height='100' widht='100'>";
				echo "</div>";
				echo "<div class='s1-cat'>".$sub_category2->s2."</div>";
				echo "</a>";

			}
			echo "</div>";
				// $mPos++;
			echo "</div>";  //end group-container div;
			echo "</td>";
			echo "</table>";

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

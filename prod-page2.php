<?php
/*
	Template Name: Products sub 2
 */

// ps2
// Data displaying Page for sub category.
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

			$p2m0 = $wp_query->query_vars['m0'];	//assign query value
			$p2s1 = $wp_query->query_vars['s1'];	// assign query value
			$p2s2 = $wp_query->query_vars['s2'];
			// print_r($p2m0);
			// print_r($p2s1);
			// print_r($p2s2);

			$main_category = $wpdb->get_results("SELECT DISTINCT m0 From wp_prod0;");
			// $main_category2 = $main_category;
			// $sub_category2 = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE m0='$p1m0' AND s1='$p1s1';");
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
					echo "<div>";
					echo "<button class='accordion'>".$main_category->m0."</button>";
					echo "<div class='panel'>";
					foreach($s1_category as $s1_category) {
						echo "<button class='accordion'>".$s1_category->s1."</button>";
						$s2_category = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE s1 = '$s1_category->s1';");
						if(!empty($s2_category[0]->s2)){
							echo "<div class='panel'>";
							foreach($s2_category as $s2_category) {
								echo "<button class='accordion'>".$s2_category->s2."</button>";
							}
							echo "</div>";
						}
					}
					echo "</div>";
				}
				else {
					echo "<div>";
					echo "<button class='accordion'>".$main_category->m0."</button>";
				}
				// echo "<hr/>";
				echo "</div>";
			}
			echo "</td>";
			// END Main Category accordion panel.
			//--------------
			// Start Right column.
			echo "<td class='prod-display'>";
			// echo "<h1> HELLO </h1>";
			// $mPos = 0;
			echo "<div class='group-container'>";
				if($p2s2!=""){
					echo "<div class='m-title'><a href='products/'>".$p2m0."</a>  >>  <a href='products/ps1/?m0=".$p2m0."&s1=".$p2s1."'>".$p2s1."</a>  >>  ".$p2s2."</div>";	//Title
					$item_data_legend = $wpdb->get_results("SELECT * FROM wp_prodlegend WHERE m0 = '$p2m0' AND s1='$p2s1' AND s2='$p2s2';");
					$item_data = $wpdb->get_results("SELECT * FROM wp_prod0 WHERE m0 = '$p2m0' AND s1='$p2s1' AND s2='$p2s2';");
				} else {
					echo "<div class='m-title'><a href='products/'>".$p2m0."</a>  >>  ".$p2s1."</div>";	//Title
					$item_data_legend = $wpdb->get_results("SELECT * FROM wp_prodlegend WHERE m0 = '$p2m0' AND s1='$p2s1';");
					$item_data = $wpdb->get_results("SELECT * FROM wp_prod0 WHERE m0 = '$p2m0' AND s1='$p2s1';");
				}
				// $s1_category2 = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$main_category2->m0';");
				// print_r($item_data_legend);
				// print_r(count($item_data_legend[0]));
				echo "<div class='s1-box-background'>";
					echo "<table>";
						echo "<td class='p2-title'>";
							if($p2s2!=""){
								echo "<div class='s2-title'><h2>".$p2s2."</h2></div>";
							} else {
								echo "<div class='s2-title'><h2>".$p2s1."</h2></div>";
							}
						echo "</td>";	// end s2-title.
						echo "<td class='p2-data'>";
						// print_r($item_data);
						echo "<div class='p2-description-txt'>";
							echo "<p>".$item_data[0]->d0."</p>";
						echo "</div>";	// end p2-description-txt.
						echo "</td>";	// end p2-description-txt.
					echo "</table>";	// end table.
					echo "<hr/>";
					echo "<table class='item-data-sheet'>";
					echo "<tr>";
					echo "<th>".$item_data_legend[0]->item."</th>";
					for ($x=1; $x < 9; $x++) {
						$cell_data = "d".$x;
						// print_r($item_data_legend[0]->$cell_data);
						// if(($item_data_legend[0]->d.$x)) {
						// 	print_r($x);
						// }
						if(($item_data_legend[0]->$cell_data)!=""){
							echo "<th>".$item_data_legend[0]->$cell_data."</th>";
						}
					}
					// echo "<th>LENGTH</th>";
					// echo "<th>TENSILE STRENGTH</th>";
					// echo "<th>BUNDLE DIAMETER</th>";
					// echo "<th>COLOR</th>";
					// echo "<th>QTY</th>";
					// echo "<th>CASE QTY</th>";
					echo "</tr>";
					foreach($item_data as $item_data) {
						echo "<tr>";
						echo "<td>".$item_data->item."</td>";
						for ($y=1; $y<9; $y++) {
							$cell_data2 = "d".$y;
							if(($item_data->$cell_data2)!="") {
								echo "<td>".$item_data->$cell_data2."</td>";
							}
						}
						// echo "<td>".$item_data->item."</td>";	//item#
						// echo "<td>".$item_data->d1."</td>";		//length aka d1.
						// echo "<td>".$item_data->d2."</td>";		//tensile str aka d2.
						// echo "<td>".$item_data->d3."</td>";		//bundle dia aka d3.
						// echo "<td>".$item_data->d4."</td>";		//color aka d4.
						// echo "<td>".$item_data->d5."</td>";		//QTY aka d5.
						// echo "<td>".$item_data->d6."</td>";		//Case QTY aka d6.
						echo "</tr>";
					}
					echo "</table>";
			// 	foreach($sub_category2 as $sub_category2) {
			// 	// $counter = 0;
			// 	$img = $wpdb->get_results("SELECT img0 FROM wp_prod0 WHERE s2 = '$sub_category2->s2' AND img0 IS NOT NULL;");
			// 	// print_r(sizeof($img));
			// 	echo "<a href='products/ps2/?m0=".$p1m0."&s1=".$p1s1."&s2=".$sub_category2->s2."' class='s1-box'>";
			// 	echo "<div class='item-img'>";
			// 	if (sizeof($img) > 1) {
			// 		// foreach($img as $img) {
			// 		// 	echo "<img src='' height='100' width='100'>";
			// 		// }
			// 		echo "<img src='".$img[array_rand($img)]->img0."' height='100' width='100'>";
			// 	} elseif (sizeof($img)===1) {
			// 		// print_r($img->img0);
			// 		echo "<img src='".$img[0]->img0."' height='100' width='100'>";
			// 	} else {
			// 		echo "<img src='http://files.coda.com.s3.amazonaws.com/imgv2/c_logo.jpg' height='100' width='100'>";
			// 	};
			// 	// echo "<img src='https://s3.amazonaws.com/files.coda.com/content/prod/categories/193-brandedcableties.jpg' height='100' widht='100'>";
			// 	echo "</div>";
			// 	echo "<div class='s1-cat'>".$sub_category2->s2."</div>";
			// 	echo "</a>";
			//
			// }
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

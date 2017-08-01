<?php
/*
	Template Name: Products Item page.
 */

// Item page
// Data displaying individual item.
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

			$item_id = $wp_query->query_vars['id'];	//assign query value
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
				$get_item_data = $wpdb->get_results("SELECT * FROM wp_prod0 WHERE item='$item_id';");
				$item_main_cat = $get_item_data[0]->m0;
				$item_sub1_cat = $get_item_data[0]->s1;
				$item_sub2_cat = $get_item_data[0]->s2;
				if($item_sub2_cat != ""){
					$get_item_legend = $wpdb->get_results("SELECT * FROM wp_prodlegend WHERE m0='$item_main_cat' AND s1='$item_sub1_cat' AND s2='$item_sub2_cat';");
					echo "<div class='m-title'><a href='products/'>".$item_main_cat."</a>  >>  <a href='products/ps1/?m0=".$item_main_cat."&s1=".$item_sub1_cat."'>".$item_sub1_cat."</a>  >>  <a href='products/ps2/?m0=".$item_main_cat."&s1=".$item_sub1_cat."&s2=".$item_sub2_cat."'>".$item_sub2_cat."</a>  >>  ".$item_id."</div>";
					// print_r("sub2 is not empty");
				} else {
					$get_item_legend = $wpdb->get_results("SELECT * FROM wp_prodlegend WHERE m0='$item_main_cat' AND s1='$item_sub1_cat';");
					echo "<div class='m-title'><a href='products/'>".$item_main_cat."</a>  >>  <a href='products/ps2/?m0=".$item_main_cat."&s1=".$item_sub1_cat."'>".$item_sub1_cat."</a>  >>  ".$item_id."</div>";	//Title
					// print_r("sub2 is empty");
				}
				echo "<div class='s1-box-background'>";
					echo "<table id='each-item-spec'>";
						echo "<td class='item-image'>";
							echo "<div class='img-content-box'>";
								for ($x=0; $x<=4; $x++) {
									$img = "img".$x;
									switch ($x) {
										case 0:
										{
											if(($get_item_data[0]->$img) !=""){
												echo "<img class='main-view-lg main-$img' src='".$get_item_data[0]->$img."'>";
											}
										}
										break;
										default:
										{
											if(($get_item_data[0]->$img) !=""){
												echo "<img class='main-view-lg main-$img' src='".$get_item_data[0]->$img."' style='display:none'>";
											}
										}
									// endswitch;
									}
								}
								echo "<br/>";
								echo "<div class='img-thumbnail-section'>";
									for ($y=0; $y<=4; $y++) {
										$img = "img".$y;
										if(($get_item_data[0]->$img) !=""){
											echo "<img class='single-thumb thumb-$img' src='".$get_item_data[0]->$img."'>";
										}
									}
								echo "</div>";	// end img-thumbnail-section;
							echo "</div>";	// end main-view-lg
						// echo "<p>IMAGE HERE</p>";
							// if($p2s2!=""){
							// 	echo "<div class='s2-title'><h2>".$p2s2."</h2></div>";
							// } else {
							// 	echo "<div class='s2-title'><h2>".$p2s1."</h2></div>";
							// }
						echo "</td>";	// end item-image.
						echo "<td class='item-data'>";
						// echo "<p>DATA HERE</p>";
							echo "<div class='item-spec-container'>";
								echo "<div class='ip-title'>".$get_item_data[0]->item."</div>";
								echo "<div class='ip-type'>".$get_item_data[0]->s1." ".$get_item_data[0]->s2." ".$get_item_data[0]->m0."</div>";
								for ($x=1; $x <=8; $x++) {
									$d = "d".$x;
									echo "<div class='ip-each-data'>";
									if ($get_item_data[0]->$d !=""){
										# Need to revise this here if datatable will be updated.;
										$splitlegend = explode("<br/>",$get_item_legend[0]->$d);
										$joinlegend = implode(" ",$splitlegend);
										// print_r($splitlegend);
										// echo "<span class='ip-legend'>".$get_item_legend[0]->$d.": </span>";
										echo "<span class='ip-legend'>".$joinlegend.": </span>";
										echo "<span class='ip-spec'>".$get_item_data[0]->$d."</span>";
									}
									echo "</div>";	// end ip-spec;
								}
								echo "<a class='spec-sheet' href='".$get_item_data[0]->d9."'>SPEC SHEET</a>";

							echo "</div>";	// end item-spec-container div;
						// print_r($item_data);
						// echo "<div class='p2-description-txt'>";
							// echo "<p>".$item_data[0]->d0."</p>";
						// echo "</div>";	// end p2-description-txt.
						echo "</td>";	// end item-data.
					echo "</table>";	// end each-item-spec table.
					echo "<div class='ip-description'>";
						echo "<h3>PRODUCT DESCRIPTION</h3>";
						echo "<p>".$get_item_data[0]->d0."</p>";
					echo "</div>";	// end ip-description;
			echo "</div>";	// end s1-box-background div;
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

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
				$item_certdb = $wpdb->get_results("SELECT * FROM wp_cert;");
				// $s1_category2 = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$main_category2->m0';");
				// print_r($item_data_legend);
				// print_r(count($item_data_legend[0]));
				echo "<div class='s1-box-background'>";
					echo "<div class='p2-header'>";
						if($p2s2!=""){
							echo "<div class='p2-title'>".$p2s2."</div>";
						} else {
							echo "<div class='p2-title'>".$p2s1."</div>";
						}
						echo "<div class='p2-description-txt'>".$item_data[0]->d0."</div>";
					echo "</div>";	// end p2-header.
					echo "<table class='p2-divider'><tr>";
						if ($item_data_legend[0]->imgdivider != ""){
							echo "<td class='p2-divider-img'><img src='".$item_data_legend[0]->imgdivider."'></td>";
						}
						// echo "<td>".$item_data."</td>";
						$certDisplay = $item_data;
						$certArr=array();
						foreach ($certDisplay as $certDisplay){
							for($c=0; $c<=9; $c++){	//There are only 0-9 certification slots at database.
								// echo $c;
								$cert = "cert".$c;
								if( $certDisplay->$cert !="" && in_array($certDisplay->$cert, $certArr)!= TRUE){
									array_push($certArr, $certDisplay->$cert);
								}
							}
						}
						// print_r(count($certArr));
						echo "<td class='p2-divider-cert'>";
							for ($iCert=0; $iCert<count($certArr); $iCert++){
								for($iCertdb = 0; $iCertdb < sizeof($item_certdb); $iCertdb++){
									if($item_certdb[$iCertdb]->type == $certArr[$iCert]) {
										echo "<img class='p2-cert-img' src='".$item_certdb[$iCertdb]->link."'>";
									}
								}
							}
						echo "</td>";
					echo "</tr></table>";
					// print_r($item_data);
					// echo count($certDisplay);

					// //--- this part work! ---
					// for ($i=0; $i<count($item_data); $i++) {
					// 	for ($j=0; $j<=9; $j++) {
					// 		$cert = "cert".$j;
					// 		if($item_data[$i]->$cert!="" && in_array($item_data[$i]->$cert,$certArr)!=TRUE){
					// 			array_push($certArr, $item_data[$i]->$cert);
					// 		}
					// 	}
					// }
					// print_r($certArr);
					// //---this part work! ---



					// echo "<table>";
					// 	echo "<td class='p2-title'>";
					// 		if($p2s2!=""){
					// 			echo "<div class='s2-title'><h2>".$p2s2."</h2></div>";
					// 		} else {
					// 			echo "<div class='s2-title'><h2>".$p2s1."</h2></div>";
					// 		}
					// 	echo "</td>";	// end s2-title.
					// 	echo "<td class='p2-data'>";
					// 	// print_r($item_data);
					// 	echo "<div class='p2-description-txt'>";
					// 		# need to discuss if subcategory description would be the same as individual description.
					// 		echo "<p>".$item_data[0]->d0."</p>";
					// 	echo "</div>";	// end p2-description-txt.
					// 	echo "</td>";	// end p2-description-txt.
					// echo "</table>";	// end table.
					// echo "<img class='s2-imgdivider' src='".$item_data_legend[0]->imgdivider."'>";
					// echo "<hr/>";	// horizontal line break.
					echo "<table class='item-data-sheet'>";
					echo "<tr >";
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
					echo "</tr>";
					foreach($item_data as $item_data) {
						echo "<tr>";
						echo "<td><a href='products/item/?id=".$item_data->item."'>".$item_data->item."</a></td>";
						for ($y=1; $y<9; $y++) {
							$cell_data2 = "d".$y;
							if(($item_data->$cell_data2)!="") {
								echo "<td>".$item_data->$cell_data2."</td>";
							}
						}
						echo "</tr>";
					}
					echo "</table>";
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

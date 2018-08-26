	<?php
		
	/*
	Plugin Name: My first Plugin
	Plugin URI: http://localhost
	*/
	
		//Apokrypsh ths admin bar gia toys subscribers
		add_action('after_setup_theme', 'remove_admin_bar');
 
		function remove_admin_bar() {
			if (!current_user_can('administrator') && !is_admin()) {
			show_admin_bar(false);
			}
		}
	
// Oi dyo aytes synarthseis trexoyn mono otan ena post dhmosieyetai gia prwth fora
		add_action('transition_post_status', 'run_when_post_published', 10, 3);
		//add_action('transition_post_status', 'GetLastPostId', 10, 3);

		function run_when_post_published($new_status, $old_status, $post){
			if ( $new_status == 'publish' && $old_status != 'publish' ) { //Elegxei prohgoymeno kai twrino status (einai gia to add_action)
				$mysqli = new mysqli( "localhost", "root", "", "wp" );
				$sql_get_users = "SELECT ID FROM wp_users";
				$ids = $mysqli->query($sql_get_users);
				
				$sql_delete = "DELETE FROM interest_array WHERE count_tags = 263"; //testing query
				$mysqli->query($sql_delete); //testing query
				
				//Antlhsh ID toy teleytaioy dhmosieymenoy post
				$mysqli2 = new mysqli( "localhost", "root", "", "wp" );
				$recent_posts = wp_get_recent_posts( array( 'numberposts' => '1' ) );
				$thePostID = $recent_posts[0]['ID'];
				
				//Antlhsh tags toy teleytaioy dhmosieymenoy post apo to ID poy vrethike parapanw
				$mysqli3 = new mysqli( "localhost", "root", "", "wp" );
				$tags_of_new_post = get_the_tags($thePostID);
				$tags_ids = array_map(create_function('$o', 'return $o->term_id;'), $tags_of_new_post);	

				foreach ($tags_ids as &$value1) {
					$the_tags_of_new_post = intval($value1);
				}
				
				//Kathgoriopoihsh endiaferontos vasei tags, ana xrhsth
				while($row = $ids->fetch_assoc()) {
					$r_id = $row["ID"];
					$sql_order_top = "SELECT tags_id FROM interest_array WHERE user_id='$r_id' ORDER BY count_tags DESC LIMIT 3";
					$sql_order_middle = "SELECT tags_id FROM interest_array WHERE user_id='$r_id' ORDER BY count_tags DESC LIMIT 4,6";
					
					$ordered_tags_per_user_top = $mysqli->query($sql_order_top);
					$top_priorities_arrays = mysqli_fetch_all($ordered_tags_per_user_top,MYSQLI_ASSOC);	
					$top_priorities = array_column($top_priorities_arrays,'tags_id');
					
					$ordered_tags_per_user_middle = $mysqli->query($sql_order_middle);
					$middle_priorities_arrays = mysqli_fetch_all($ordered_tags_per_user_middle,MYSQLI_ASSOC);
					$middle_priorities = array_column($middle_priorities_arrays,'tags_id');
					
					$result = array_intersect($top_priorities, $tags_ids);					
					if(empty($result)) {
						$result2 = array_intersect($middle_priorities, $tags_ids);
						if(empty($result2)) {
							//Kamia eidopoihsh
						}
						else { //if(!empty($result2)) 
							//Eidopoihsh gia priority 2
						}
					}
					else {//if(!empty($result1)){
						//Eidopoihsh gia priority 1
						//Testing code underneath
						print_r('ok');
						$mysqli8 = new mysqli( "localhost", "root", "", "wp" );
						$sql_test = "INSERT INTO interest_array (user_id, tags_id, count_tags) VALUES (555, 444,444)";
						$query5 = $mysqli8->query($sql_test);
						$mysqli8->close();
					}
					}
				$mysqli->close();	

			}
		}
?>
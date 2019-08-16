<?php
/**
 * Template Name: UA Directcory Page Template
 
 * Description: UA Directcory Page Template
 *
 *
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="ua-staff-post" role="main">
			
    		<?php the_post(); ?>

			<?php get_template_part( 'content', '' ); ?>

			
			<script type="text/javascript">
				Array.prototype.contains = function(v) {
					for(var i = 0; i < this.length; i++) {
						if(this[i] === v) return true;
					}
					return false;
				};
				
				Array.prototype.unique = function() {
					var arr = [];
					for(var i = 0; i < this.length; i++) {
						if(!arr.contains(this[i])) {
							arr.push(this[i]);
						}
					}
					return arr; 
				}
				
				Array.prototype.clean = function(deleteValue) {
				  for (var i = 0; i < this.length; i++) {
					if (this[i] == deleteValue) {         
					  this.splice(i, 1);
					  i--;
					}
				  }
				  return this;
				};
				
				jQuery(document).ready(function(){
				/* ---- ua staff directory ----- */
				jQuery("#ua-staff-directory").tablesorter(); 
				jQuery('#ua-staff-directory').filterTable();
				
				var unitArray = [],
				  uniques = [];
				  jQuery(".ua-staff-directory-unit").each(function(index, value) {
					unitArray.push(jQuery(this).text());
				  });
				  
				  uniques = unitArray.unique();
				  uniques = uniques.clean("");
				  uniques.sort();
				  
				  jQuery.each(uniques, function(index, value) {
					jQuery("#ua-staff-directory-unit-select").append("<option>" + value + "</option>");
				  });
				
				});
				
			</script>

            
				 <?php
			$url = 'http://api.gifts.washington.edu/StaffService/v1/api/staff?pageindex=0&pagesize=2000';
			//$request = new WP_Http; // or use the $wp_http global
			//$response = $request->request( $url );
			$arg = array(
				'method' => 'GET',
				'timeout' => '20'
			);  
			$response = wp_remote_request ( $url , $arg );  
			
			if (!is_wp_error ($response) ) {
				echo "<div id='ua-staff-directory-unit-select-container'><span id='filter-or'>or</span>
						  <select id=\"ua-staff-directory-unit-select\">
							<option>choose unit</option>
						  </select>
					  </div>";
				$json = $response['body'];
				$data = json_decode($json, true);
				echo '<table width="600" cellpadding="5" id="ua-staff-directory">';
				echo '<thead><tr><th>Name</th><th>Box</th><th>Phone</th><th>Email</th><th>Unit</th><th>Title</th></tr></thead><tbody>';
				foreach ($data as $key => $val) {
					echo "<tr><td>" . $val['FirstName'] . " " . $val['LastName'] . '</td><td>' . $val['Box'] . "</td><td>". $val['Phone'] . "</td><td>". "<a href='mailto:" . $val['Email'] . "'>" . $val['NetID'] . "</a></td><td class='ua-staff-directory-unit'>" . $val['Unit'] . "</td><td>" . $val['Title'] . "</td></tr>";
				}				
				echo "</tbody></table>";
    		} else {
        		//echo $response->get_error_message(), $response->get_error_code();
				echo "<h2>We're sorry, this page can not be loaded at this time.</h2>";
			}			
		?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>
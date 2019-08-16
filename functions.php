<?php

// allows child them overwriting of either whole UW object or just parts
if (!function_exists('setup_uw_object')){
    function setup_uw_object() {
        require( get_template_directory() . '/setup/class.uw.php' );
        $UW = new UW();
        do_action('extend_uw_object', $UW);
        return $UW;
    }
}

$UW = setup_uw_object();

function wpb_last_updated_date( $content ) {
$u_time = get_the_time('U'); 
$u_modified_time = get_the_modified_time('U'); 
if ($u_modified_time >= $u_time + 86400) { 
$updated_date = get_the_modified_time('F jS, Y');
$updated_time = get_the_modified_time('h:i a'); 
$custom_content .= '<p class="last-updated">Last updated on '. $updated_date . '</p>';  
} 
 
    $custom_content .= $content;
    return $custom_content;
}
add_filter( 'the_content', 'wpb_last_updated_date' );

function replace_meta_box() {
		add_meta_box( 'uwpageparentdiv', 'Page Attributes', array( $this, 'page_attributes_meta_box' ), 'page', 'side', 'core' );
	}

/**
 * This function prints (if echo param is not false) the HTML for an announcement item (icon, title, post content)
 * 
 * @param boolean $echo Specify wether to echo (true) or print (false)
 */
function the_announcement($echo = true){
	$announcement_icon = strtolower(get_post_meta(get_the_ID(), 'announcement_type', true ));
									$announcement_permalink = esc_url( get_permalink() );
									$announcement_title = the_title('','',false);
									$announcement_default_excerpt = get_the_excerpt();
									$announcement_excerpt = get_post_meta(get_the_ID(), 'announcement_excerpt', true );
									if(empty($announcement_excerpt)){
										$announcement_excerpt = $announcement_default_excerpt;
									}
									$announcement_html = <<<erhvsfvsfsza
									<div class="isc-announcement-item">
										<style>
											.isc-announcement-icon-$announcement_icon:before {
												content: "\\$announcement_icon";
											}
										</style>
										<i class="fa isc-btn-icon isc-announcement-icon isc-announcement-icon-$announcement_icon"></i>
										<div class="isc-announcement-content">
											<h3 class="isc-announcement-title">
												<a href="$announcement_permalink">$announcement_title</a>
											</h3>
											<div class="post-content isc-announcement-excerpt">$announcement_excerpt</div>
										</div>
									</div>
erhvsfvsfsza;
	if($echo){
		echo $announcement_html;
	}
	else{
		return $announcement_html;
	}
}

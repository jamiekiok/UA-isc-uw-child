<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
      $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      $sidebar = get_post_meta($post->ID, "sidebar");   ?>

<?php uw_site_title(); ?>
<?php get_template_part( 'menu', 'mobile' ); ?>

<div class="container uw-body">

    <div class="row">
        <div class="col-md-12">
            <?php get_template_part( 'breadcrumbs' ); ?>
        </div>
    </div>

    <div class="row">

        <div class="uw-content col-md-9 " role='main'>

            <div id='main_content' class="uw-body-copy" tabindex="-1">

                xxxx this template uses default-template.php (inside tribe-events directory) xxxx

				<div id="tribe-events-pg-template">
					<ul>
					<?php
					//tribe_get_view();
					//'post_type' => 'tribe_events'

					$args = array(
						'post_type' => 'tribe_events',
						'post_status' => 'publish'
				 );
				 //if ()
				 //log_to_console($events);
				 $events = get_posts( $args );
				 //log_to_console($events);
				 if (empty($events)) {
					 echo "<div class='col-md-6'>No events found!</div>";
				 } else {
					 foreach ($events as $event) {
						 $title = $event->post_title;
						 $html = "<ol>";
						 $html .= '<h4><a href="' . get_post_permalink($event->ID) . '">' . $title . '</a> </h4>';
						 $html .= "<p>" . tribe_get_start_date($event) . "</p>";
						 if (tribe_has_venue($event->ID)) {
							 $details = tribe_get_venue_details($event->ID);
							 $html .= "<p>" . $details["linked_name"] . "</p>";
							 $html .= "<p>" . $details["address"] . "</p>";
						 } else {
							 $html .= "<p>Location to be determined.</p>";
						 }
						 $html .= "<p>" . $event->post_content . "</p>";
						 $html .= "</ol>";
						 echo $html;
					 }
				 }
					?>
					</ul>
				</div>

            </div>

        </div>

    </div>

</div>

<?php
get_footer();
?>

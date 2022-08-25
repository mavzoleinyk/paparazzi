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

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>

<?php include(get_template_directory() . '/header.php'); ?>

    <div class="container" id="tribe-events-pg-template">

        <div class="row main-content">

                <?php tribe_events_before_html(); ?>
                <?php tribe_get_view(); ?>
                <?php tribe_events_after_html(); ?>

        </div>

    </div>

<?php include(get_template_directory() . '/footer.php'); ?>
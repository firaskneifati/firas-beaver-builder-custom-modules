<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * MMGoogleMap: 
 */

?>
<h1><?php echo esc_html($settings->mm_google_map_heading_text); ?></h1>
<div class="mm-google-map"></div>
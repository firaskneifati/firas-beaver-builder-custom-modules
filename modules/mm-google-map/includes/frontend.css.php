/**
 * This file should contain frontend styles that 
 * will be applied to individual module instances.
 *
 * You have access to three variables in this file: 
 * 
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 * MMGoogleMap: 
 */

<?php
    $global_settings = FLBuilderModel::get_global_settings();
    $responsive_breakpoint = $global_settings->responsive_breakpoint;
    $medium_breakpoint = $global_settings->medium_breakpoint;
?>

.fl-node-<?php echo $id; ?> h1{
    font-size: <?php echo $settings->mm_google_map_heading_font_size_responsive; ?>px;
}
@media (min-width: <?php echo $responsive_breakpoint; ?>px){
    .fl-node-<?php echo $id; ?> h1{
        font-size: <?php echo $settings->mm_google_map_heading_font_size_medium; ?>px;
    }
}
@media (min-width: <?php echo $medium_breakpoint; ?>px){
    .fl-node-<?php echo $id; ?> h1{
        font-size: <?php echo $settings->mm_google_map_heading_font_size; ?>px;
    }
}
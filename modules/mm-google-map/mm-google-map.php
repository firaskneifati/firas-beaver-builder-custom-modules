<?php

/**
 * @class FLMMGoogleMapModule
 */
class FLMMGoogleMapModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Multiple Marker Google Map', 'fl-builder'),
            'description'   => __('Multiple Marker Google Map Module.', 'fl-builder'),
            'category'		=> __('Firas Custom Modules', 'fl-builder'),
            'dir'           => FIRAS_BEAVER_MODULES_DIR . 'modules/mm-google-map/',
            'url'           => FIRAS_BEAVER_MODULES_URL . 'modules/mm-google-map/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
        
        /** 
         * Use these methods to enqueue css and js already
         * registered or to register and enqueue your own.
         */
        // Already registered
        $this->add_css('font-awesome');
        $this->add_js('jquery-bxslider');
    }

    /** 
     * Use this method to work with settings data before 
     * it is saved. You must return the settings object.
     *
     * @method update
     * @param $settings {object}
     */      
    public function update($settings)
    {
        return $settings;
    }

    public function add_async_attribute($tag, $handle) {
        // add script handles to the array below
        $scripts_to_async = array(
            'google-maps-api',
        );
        
        foreach($scripts_to_async as $async_script) {
           if ($async_script === $handle) {
              return str_replace(' id=', ' async id=', $tag);
           }
        }
        return $tag;
    }

    /* public function enqueue_scripts(){
        parent::enqueue_scripts();

        add_filter('script_loader_tag', array($this, 'add_async_attribute'), 10, 2);
        if ( !empty($this->settings->google_maps_api_key_field)) {
            global $post;
            $deps = array();
            if(!empty ($post)){
                $handle = 'fl-builder-layout-' . $post->ID;
                array_push($deps, $handle);
            }
            $this->add_js('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='.$this->settings->google_maps_api_key_field.'&callback=initMap&v=weekly', $deps, null, true);
        }
    } */
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLMMGoogleMapModule', array(
    'general'       => array( // Tab
        'title'         => __('Map Settings', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'google_maps_api_key_field'     => array(
                        'type'          => 'text',
                        'label'         => __('Google API Key', 'fl-builder'),
                        'maxlength'     => '100',
                        'help'          => 'Enter your Google Maps API key here',
                        'preview'         => array(
                            'type'             => 'text'
                        )
                    ),
                    'mm_google_map_heading_text'     => array(
                        'type'          => 'text',
                        'label'         => __('Heading Text', 'fl-builder'),
                        'default'       => 'Restaurants Map By Firas Kneifati',
                        'maxlength'     => '100',
                        'preview'         => array(
                            'type'             => 'text'
                        )
                    ),
                    'mm_google_map_heading_font_size' => array(
                        'type'        => 'unit',
                        'label'       => 'Heading Font Size',
                        'description' => 'px',
                        'responsive'  => array(
                            'placeholder' => array(
                                'default' =>  36,
                                'medium' =>  24,
                                'responsive' =>  16,
                            ),
                        ),
                    ),
                )
            )
        )
    ),
    'multiple'      => array( // Tab
        'title'         => __('Restaurant Locations', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'mm_google_map_locations'          => array(
                        'type'          => 'form',
                        'label'         => __('Restaurant', 'fl-builder'),
                        'multiple'      => true, // Doesn't work with editor or photo fields
                        'form'          => 'mm_google_map_location_form',
                        'preview_text'  => 'location_name',
                    )
                )
            )
        )
    ),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('mm_google_map_location_form', array(
    'title' => __('MMGoogleMap Form Settings', 'fl-builder'),
    'tabs'  => array(
        'general'  => array( // Tab
            'title'     => __('General', 'fl-builder'), // Tab title
            'sections'  => array( // Tab Sections
                'general'  => array( // Section
                    'title'  => '', // Section Title
                    'fields' => array( // Section Fields
                        'location_name' => array(
                            'type'    => 'text',
                            'label'   => __('Restaurant Name', 'fl-builder'),
                            'default' => 'Symposium Cafe Restaurant & Lounge',
                        ),
                        'location_lon' => array(
                            'type'    => 'text',
                            'label'   => __('Restaurant Longitude', 'fl-builder'),
                            'default' => '43.51115407076263',
                        ),
                        'location_lat' => array(
                            'type'    => 'text',
                            'label'   => __('Restaurant Latitude', 'fl-builder'),
                            'default' => '-79.85508335311363',
                        ),
                    )
                )
            )
        ),
    )
));
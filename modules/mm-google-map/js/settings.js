(function($){

    /**
     * Use this file to register a module helper that
     * adds additional logic to the settings form. The
     * method 'FLBuilder._registerModuleHelper' accepts
     * two parameters, the module slug (same as the folder name)
     * and an object containing the helper methods and properties.
     */
    FLBuilder._registerModuleHelper('mm-google-map', {
        
        /**
         * The 'rules' property is where you setup
         * validation rules that are passed to the jQuery
         * validate plugin (http://jqueryvalidation.org).
         *
         * @property rules
         * @type object
         */
        rules: {
            google_maps_api_key_field: {
                required: true
            },
            mm_google_map_heading_text: {
                required: true
            },
            mm_google_map_heading_font_size: {
                required: true
            },
        },
        
        /**
         * The 'init' method is called by the builder when 
         * the settings form is opened.
         *
         * @method init
         */
        init: function()
        {
            
        },
        
        /**
         * The 'submit' method is called by the builder when 
         * the settings form is submitted and has passed validation.
         * You must return true for the form to submit. Return false
         * to stop the form from being submitted.
         *
         * @method submit
         */
        submit: function()
        {
            return true;
        }
    });

    /**
     * Validate a nested form created with 'type' => 'form'. 
     */
    FLBuilder._registerModuleHelper('mm_google_map_location_form', {
        
        rules: {
            location_name: {
                required: true
            },
            location_lon: {
                number: true,
                required: true
            },
            location_lat: {
                number: true,
                required: true
            },
        },
        
        init: function()
        {

        },
        
        submit: function()
        {
            return true;
        }
    });

})(jQuery);
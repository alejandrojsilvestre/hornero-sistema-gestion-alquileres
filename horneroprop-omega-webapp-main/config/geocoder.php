<?php

return [

    /*
     * The api key used when sending Geocoding requests to Google.
     */
    'key' => env('GOOGLE_MAPS_API_KEY', 'AIzaSyDJOL5hjK6TAG4wAAGiI7ZrjmDkdmQ9_Qg'),

    /*
     * The language param used to set response translations for textual data.
     *
     * More info: https://developers.google.com/maps/faq#languagesupport
     */

    'language' => '',

    /*
     * The region param used to finetune the geocoding process.
     *
     * More info: https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
     */
    'region' => env('GOOGLE_MAPS_LOCALE', 'ar'),

    /*
     * The bounds param used to finetune the geocoding process.
     *
     * More info: https://developers.google.com/maps/documentation/geocoding/intro#Viewports
     */
    'bounds' => '',

    /*
     * The country param used to limit results to a specific country.
     *
     * More info: https://developers.google.com/maps/documentation/javascript/geocoding#GeocodingRequests
     */
    'country' => env('GOOGLE_MAPS_LOCALE', 'ar'),

];

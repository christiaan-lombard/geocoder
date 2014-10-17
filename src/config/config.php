<?php


return array(
    // Providers get called in the chain order given here.
    // The first one to return a result will be used.
    'providers' => array(
        'Geocoder\Provider\GeoPluginProvider'  => null,
    ),
    'adapter'  => 'Geocoder\HttpAdapter\CurlHttpAdapter'
);
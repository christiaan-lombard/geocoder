<?php


return array(
    // Providers get called in the chain order given here.
    // The first one to return a result will be used.
    'providers' => array(
        'Geocoder\Provider\GeoPluginProvider'  => null,
        'Geocoder\Provider\FreeGeoIpProvider'  => null,
        'Geocoder\Provider\HostIpProvider'  => null,
    ),
    'adapter'  => 'Geocoder\HttpAdapter\CurlHttpAdapter',

    'cache_minutes' => 500
);
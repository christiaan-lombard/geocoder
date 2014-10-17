<?php


return array(
    // Providers get called in the chain order given here.
    // The first one to return a result will be used.
    'providers' => array(
        'Geocoder\Provider\GoogleMapsProvider' => array('fr-FR', 'Île-de-France', true),
        'Geocoder\Provider\FreeGeoIpProvider'  => null,
    ),
    'adapter'  => 'Geocoder\HttpAdapter\CurlHttpAdapter'
);
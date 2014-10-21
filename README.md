# Laravel Geocoder

Laravel 5 wrapper for Geocoder-PHP lib (http://geocoder-php.org/Geocoder/) with added caching.

For Laravel 4, see https://github.com/geocoder-php/GeocoderLaravel

##Installation (Composer):

> Not in packagist yet


    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/yousemble/laravel-geocoder"
        }
    ],

    "require": {
        "yousemble/geocoder": "dev-master",
    },


##Usage

Add the service provider to *config/app.php*:

    'providers' => array(
      //...
      'Yousemble\Geocoder\GeocoderServiceProvider',
    ),

###Facade

The GeocoderServiceProvider registers a *Yousemble\Geocoder\GeocoderService* singleton instance.
To use the Geocoder facade, register the following alias in *config/app.php*:

    'aliases' => array(
      //..
      'Geocoder' => 'Yousemble\Geocoder\Facades\GeocoderFacade',
    ),

The GeocoderFacade grabs the singleton *Yousemble\Geocoder\GeocoderService*.

###Method Injection

To inject a GeocoderService instance, use the *Yousemble\Geocoder\Contracts\GeocoderService* interface,
bound to *Yousemble\Geocoder\GeocoderService*

    <?php

    //...

    use Yousemble\Geocoder\Contracts\GeocoderService as GeocoderServiceContract;

    //...

    public function __construct(GeocoderServiceContract $geocoder)
    {
      $result = $geocoder->geocodeRemoteAddr();
      //...
    }
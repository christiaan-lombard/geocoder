<?php

namespace Yousemble\Geocoder;

use Geocoder\GeocoderInterface as GeocoderContract;
use Illuminate\Contracts\Cache\Repository as CacheContract;
use Yousemble\Geocoder\Contracts\GeocoderService as GeocoderServiceContract;


class GeocoderService implements GeocoderServiceContract
{

  private $geocoder;
  private $cache;
  private $cacheMinutes;

  function __construct(GeocoderContract $geocoder, CacheContract $cache, $cache_minutes = 10080){
    $this->geocoder = $geocoder;
    $this->cache = $cache;
    $this->cacheMinutes = $cache_minutes;
  }

  /**
   * Geocode a given value.
   *
   * @param string $value A value to geocode.
   *
   * @return ResultInterface A ResultInterface result object.
   */
  public function geocode($value){

    //TODO - check cache first

    $result = $this->geocoder->geocode($value);

    //TODO - store result in cache

    return $result;

  }

  public function geocodeRemoteAddr(){
    return $this->geocode($_SERVER['REMOTE_ADDR']);
  }

  /**
   * Reverse geocode given latitude and longitude values.
   *
   * @param double $latitude  Latitude.
   * @param double $longitude Longitude.
   *
   * @return ResultInterface A ResultInterface result object.
   */
  public function reverse($latitude, $longitude){
    return $this->geocoder->reverse($latitude, $longitude);
  }

  protected function getValueCacheKey($value){
    return 'geocode-value-' . $value;
  }

  protected function getCacheMinutes(){
    return $this->cacheMinutes;
  }

}
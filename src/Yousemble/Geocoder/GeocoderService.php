<?php namespace Yousemble\Geocoder;

use Geocoder\GeocoderInterface as GeocoderContract;
use Illuminate\Contracts\Cache\Repository as CacheContract;
use Yousemble\Geocoder\Contracts\GeocoderService as GeocoderServiceContract;

use Geocoder\Result\Geocoded;


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

    $cache_key = $this->getValueCacheKey($value);


    //check cache first
    if($this->cache->has($cache_key)){
      $result = new Geocoded;
      $result->fromArray($this->cache->get($cache_key));
      return  $result;
    }

    //get the result from our geocoder
    $result = $this->geocoder->geocode($value);

    //store result in cache
    $this->cache->put($cache_key, $result->toArray(), $this->cacheMinutes);

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
    return str_replace([':','.'],'_','_geocode_' . $value);
  }

  protected function getCacheMinutes(){
    return $this->cacheMinutes;
  }

}
<?php namespace Yousemble\Geocoder\Contracts;

use Geocoder\Result\ResultInterface;

interface GeocoderService{



  /**
   * Geocode a given value.
   *
   * @param string $value A value to geocode.
   *
   * @return ResultInterface A ResultInterface result object.
   */
  public function geocode($value);
  public function geocodeRemoteAddr();

  /**
   * Reverse geocode given latitude and longitude values.
   *
   * @param double $latitude  Latitude.
   * @param double $longitude Longitude.
   *
   * @return ResultInterface A ResultInterface result object.
   */
  public function reverse($latitude, $longitude);
}


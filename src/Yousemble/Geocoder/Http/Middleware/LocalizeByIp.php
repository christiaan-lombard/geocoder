<?php namespace Yousemble\Geocoder\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application as IlluminateApplication;
use Yousemble\Geocoder\Contracts\GeocoderService as Geocoder;

class LocalizeByIp implements Middleware {

  protected $app;
  protected $geocoder;

  public function __construct(IlluminateApplication $app, Geocoder $geocoder)
  {
    $this->app = $app;
    $this->geocoder = $geocoder;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   *
   * @throws TokenMismatchException
   */
  public function handle($request, Closure $next)
  {




    return $this->addCookieToResponse($request, $next($request));


    throw new TokenMismatchException;
  }


}

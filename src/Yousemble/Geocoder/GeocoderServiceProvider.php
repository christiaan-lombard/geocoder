<?php namespace Yousemble\Geocoder;


use Geocoder\Geocoder;
use Geocoder\Provider\ChainProvider;
use Yousemble\Geocoder\GeocoderService;
use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('yousemble/geocoder', 'ysgeocoder');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

    $configured_providers = $this->app->config->get('ysgeocoder::geocoder.providers', ['Geocoder\Provider\GeoPluginProvider']);
    $configured_cache_minutes = $this->app->config->get('ysgeocoder::geocoder.cache_minutes', 10080);

    $this->app->singleton('Ivory\HttpAdapter\HttpAdapterInterface')


    $this->app->singleton('Geocoder\Provider\Provider', function($app) use ($configured_providers){

      $providers = [];

      foreach ($configured_providers as $provider_class => $data) {

      }

    });

    $this->app->singleton('Geocoder\Geocoder', '');


  /*
    $this->app->singleton('geocoder.adapter', function($app) {
        $adapter = $app['config']->get('geocoder::adapter');

        return new $adapter;
    });

    $this->app->singleton('geocoder.chain', function($app) {
        $providers = array();

        foreach($app['config']->get('geocoder::providers') as $provider => $arguments) {
            if (0 !== count($arguments)) {
                $providers[] = call_user_func_array(
                    function ($arg1 = null, $arg2 = null, $arg3 = null, $arg4 = null) use ($app, $provider) {
                        return new $provider($app['geocoder.adapter'], $arg1, $arg2, $arg3, $arg4);
                    },
                    $arguments
                );

                continue;
            }

            $providers[] = new $provider($app['geocoder.adapter']);
        }

        return new ChainProvider($providers);
    });

    $this->app->bindShared('Geocoder\GeocoderInterface', function($app) {
        $geocoder = new Geocoder;
        $geocoder->registerProvider($app['geocoder.chain']);
        return $geocoder;
    });

    $this->app->bindShared('Yousemble\Geocoder\Contracts\GeocoderService', function($app){
        $geocoderService = new Geocoder($app['Geocoder\GeocoderInterface'], $app['cache.store'], $app['config']->get('geocoder::cache_minutes'));
        return $geocoderService;
    });*/
	}

  protected function mapConfigToProvider($provider, array $config = null)
  {
      $dependencies = [];
      $class = new ReflectionClass($provider);
      foreach ($class->getConstructor()->getParameters() as $parameter)
      {
          $name = $parameter->getName();
          if (array_key_exists($name, $config))
          {
              $dependencies[] = $config[$name];
          }
          elseif($name === 'adapter')
          {
            $dependencies[] = $this->app->make($parameter->getClass());
          }
          elseif ($parameter->isDefaultValueAvailable())
          {
            $dependencies[] = $parameter->getDefaultValue();
          }
          else
          {
              throw new InvalidArgumentException("Unable to map config to provider: {$name}");
          }
      }
      return $class->newInstanceArgs($dependencies);
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
      return array();
  }

}

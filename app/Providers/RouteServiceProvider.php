<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Translation\Translator as Lang;
use Illuminate\Http\Request;
use Illuminate\Config\Repository as Config;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Web namespace
     *
     * @var string
     */
    protected $namespaceWeb = 'App\Http\Controllers\Web';

    /**
     * Api namespace
     *
     * @var string
     */
    protected $namespaceApi = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);

        $router->pattern('id', '[1-9][0-9]*');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router, Lang $lang, Request $request, Config $config)
    {
        $rootUrl = $request->root().'/';

        // set configuration data
        $this->setConfig($config, $rootUrl);

        // map routes
        $this->mapWebRoutes($router, $lang, $config);
        $this->mapApiRoutes($router, $config);
        $this->mapCdnRoutes($router, $config);
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @param  \Illuminate\Translation\Translator  $lang
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    protected function mapWebRoutes(Router $router, Lang $lang, Config $config)
    {
       $rootWeb = parse_url($config->get('app.url_web'), PHP_URL_HOST);

        $router->group([
            'domain' => $rootWeb,
            'namespace' => $this->namespaceWeb,
            'middleware' => 'web'
        ], function ($router) use ($lang) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    protected function mapApiRoutes(Router $router, Config $config)
    {
       $rootApi = parse_url($config->get('app.url_api'), PHP_URL_HOST);

        $router->group([
            'domain' => $rootApi,
            'namespace' => $this->namespaceApi,
            'middleware' => 'api'
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

    /**
     * Define the "cdn" routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    protected function mapCdnRoutes(Router $router, Config $config)
    {
        $rootCdn = parse_url($config->get('app.url_cdn'), PHP_URL_HOST);

        $router->group([
            'domain' => $rootCdn,
            'namespace' => $this->namespaceCdn
        ], function ($router) {
            require base_path('routes/cdn.php');
        });
    }

    /**
     * Set configuration data based on locale
     *
     * @param  \Illuminate\Config\Repository  $config
     * @param  string  $rootUrl
     * @return void
     */
    private function setConfig(Config $config, $rootUrl)
    {
        // set app url
        $config->set('app.url', $rootUrl);

        // set stateless sessions on cdn subdomain
        if ($rootUrl == $config->get('app.url_cdn')) {
            $config->set('session.driver', 'array');
        }
    }
}

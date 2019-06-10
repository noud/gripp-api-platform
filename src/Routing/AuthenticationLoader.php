<?php

namespace App\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class AuthenticationLoader extends Loader
{
    /**
     * @var string
     */
    private $pathPrefix;

    /**
     * @var bool
     */
    private $isLoaded = false;

    public function __construct(string $pathPrefix)
    {
        $this->pathPrefix = $pathPrefix;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Config\Loader\LoaderInterface::load()
     */
    public function load($resource, $type = null): RouteCollection
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the "authentication" loader twice');
        }

        $routes = new RouteCollection();

        // prepare login route
        $path = '/'.$this->pathPrefix.'/login';
        $defaults = [
            '_controller' => 'App\Controller\LoginController::loginAction',
        ];
        $requirements = [];
        $route = new Route($path, $defaults, $requirements);

        // add the new route to the route collection
        $routeName = 'sonata_login';
        $routes->add($routeName, $route);

        // prepare logout route
        $path = '/'.$this->pathPrefix.'/logout';
        $defaults = [
            '_controller' => 'App\Controller\LoginController::logoutAction',
        ];
        $requirements = [];
        $route = new Route($path, $defaults, $requirements);

        // add the new route to the route collection
        $routeName = 'sonata_logout';
        $routes->add($routeName, $route);

        $this->isLoaded = true;

        return $routes;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Config\Loader\LoaderInterface::supports()
     */
    public function supports($resource, $type = null): bool
    {
        return 'authentication' === $type;
    }
}
